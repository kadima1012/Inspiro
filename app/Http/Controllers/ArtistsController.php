<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\User;
use App\Models\Order;
use App\Models\Artwork;


class ArtistsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $artists = Artist::query()
            ->where('artist_first_name', 'LIKE', "%{$search}%")
            ->orWhere('artist_last_name', 'LIKE', "%{$search}%")
            ->orWhere('artist_description', 'LIKE', "%{$search}%")
            ->orWhere('artist_experience', 'LIKE', "%{$search}%")
            ->orWhere('artist_portofolio', 'LIKE', "%{$search}%")
            ->get();

        return view('dashboard.artists', compact('artists'));
    }

    public function portfolio(Request $request)
    {
        $user = auth()->user();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if ($artist) {
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
                case 'all':
                default:
                    break;
            }

            $artworks = $artworks->get();

            return view('dashboard.portfolio', compact('artist', 'artworks'));
        } else {
            return redirect()->route('dashboard')->with('status', 'You are not an artist.');
        }
    }




    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        return view('artist.edit', compact('artist'));
    }



    public function update(Request $request, $idArtist)
    {
        $request->validate([
            'artist_first_name' => 'required|string',
            'artist_last_name' => 'required|string',
            'artist_description' => 'required|string',
            'artist_experience' => 'required|integer',
        ]);

        $data = $request->only([
            'artist_first_name',
            'artist_last_name',
            'artist_description',
            'artist_experience'
        ]);

        Artist::updateArtist($idArtist, $data);

        return redirect()->route('portfolio')->with('success', 'Artist details updated successfully!');
    }

    public function show($id)
    {
        $artist = Artist::with('artworks')->findOrFail($id);
        return view('dashboard.portfolio', compact('artist'));
    }


    public function create(Request $request)
    {
        $idUser = $request->input('user_id');

        $user = User::find($idUser);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $roles = $user->roles;

        $isUserRole = $roles->contains(function($role) {
            return $role->name === 'user';
        });

        if (!$isUserRole) {
            return redirect()->back()->with('error', 'User already has the artist rights.');
        }

        $artist = new Artist();
        $artist->artist_first_name = $request->input('artist_first_name');
        $artist->artist_last_name = $request->input('artist_last_name');
        $artist->artist_description = $request->input('artist_description');
        $artist->artist_experience = $request->input('artist_experience');
        $artist->artist_email = $user->email;
        $artist->idUser = $idUser;

        $artist->save();

        $user->roles()->detach();
        $user->assignRole('artist');

        return redirect()->route('adminPanel')->with('success', 'Artist created with success.');
    }

    public function sale()
    {
        $user = auth()->user();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if ($artist) {
            $orders = Order::where('idArtist', $artist->idArtist)
                            ->where(function ($query) {
                                $query->where('order_status', '!=', 'in cart')
                                    ->orWhereNull('order_status');
                            })
                            ->with(['user' => function($query) {
                                    $query->select('users.idUser','users.user_first_name','users.user_last_name','users.email','users.user_username');
                                } ,
                                'artworks' => function ($query) {
                                    $query->select('artwork.idArt', 'artwork.art_Title', 'artwork.art_Description', 'artwork.art_quantity', 'order_artwork.quantity_to_order', 'artwork.filepath');
                                }
                            ])
                            ->get();

            return view('dashboard.my_sale', compact('orders'));
        } else {
            return redirect()->route('dashboard')->with('status', 'You are not an artist.');
        }
    }
}
