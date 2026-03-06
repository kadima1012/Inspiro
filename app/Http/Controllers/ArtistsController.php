<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateArtistRequest;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtistsController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $artists = Artist::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('artist_first_name', 'LIKE', "%{$search}%")
                        ->orWhere('artist_last_name', 'LIKE', "%{$search}%")
                        ->orWhere('artist_description', 'LIKE', "%{$search}%")
                        ->orWhere('artist_experience', 'LIKE', "%{$search}%")
                        ->orWhere('artist_portofolio', 'LIKE', "%{$search}%");
                });
            })
            ->get();

        return view('dashboard.artists', compact('artists'));
    }

    public function portfolio(Request $request): View|RedirectResponse
    {
        $user = auth()->user();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if (!$artist) {
            return redirect()->route('dashboard')->with('status', 'You are not an artist.');
        }

        $category = $request->input('category', 'all');
        $artworks = $artist->artworks();

        switch ($category) {
            case 'visible':
                $artworks->where('art_Status', 'Active');
                break;
            case 'shop':
                $artworks->whereHas('shopList');
                break;
            case 'pending':
                $artworks->where('art_Status', 'Pending');
                break;
            case 'declined':
                $artworks->where('art_Status', 'Declined');
                break;
        }

        $artworks = $artworks->get();

        return view('dashboard.portfolio', compact('artist', 'artworks'));
    }

    public function edit(int $id): View
    {
        $artist = Artist::findOrFail($id);

        return view('artist.edit', compact('artist'));
    }

    public function update(UpdateArtistRequest $request, int $idArtist): RedirectResponse
    {
        $data = $request->validated();

        Artist::updateArtist($idArtist, $data);

        return redirect()->route('portfolio')->with('success', 'Artist details updated successfully!');
    }

    public function show(int $id): View
    {
        $artist = Artist::with('artworks')->findOrFail($id);

        return view('dashboard.portfolio', compact('artist'));
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,idUser',
            'artist_first_name' => 'required|string|max:255',
            'artist_last_name' => 'required|string|max:255',
            'artist_description' => 'required|string|max:512',
            'artist_experience' => 'required|integer|min:0',
        ]);

        $user = User::findOrFail($request->input('user_id'));

        if (!$user->hasRole('user')) {
            return redirect()->back()->with('error', 'User already has the artist rights.');
        }

        $artist = Artist::create([
            'artist_first_name' => $request->input('artist_first_name'),
            'artist_last_name' => $request->input('artist_last_name'),
            'artist_description' => $request->input('artist_description'),
            'artist_experience' => $request->input('artist_experience'),
            'artist_email' => $user->email,
            'idUser' => $user->idUser,
        ]);

        $user->assignRole('artist');

        return redirect()->route('adminPanel')->with('success', 'Artist created with success.');
    }

    public function sale(): View|RedirectResponse
    {
        $user = auth()->user();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if (!$artist) {
            return redirect()->route('dashboard')->with('status', 'You are not an artist.');
        }

        $orders = Order::where('idArtist', $artist->idArtist)
            ->where(function ($query) {
                $query->where('order_status', '!=', Order::STATUS_IN_CART)
                    ->orWhereNull('order_status');
            })
            ->with([
                'user' => function ($query) {
                    $query->select('users.idUser', 'users.user_first_name', 'users.user_last_name', 'users.email', 'users.user_username');
                },
                'artworks' => function ($query) {
                    $query->select('artwork.idArt', 'artwork.art_Title', 'artwork.art_Description', 'artwork.art_quantity', 'order_artwork.quantity_to_order', 'artwork.filepath');
                },
            ])
            ->get();

        return view('dashboard.my_sale', compact('orders'));
    }
}
