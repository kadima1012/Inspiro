<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtworkRequest;
use App\Http\Requests\UpdateArtworkRequest;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\ArtworkType;
use App\Models\ShopList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArtworkController extends Controller
{
    public function create(Request $request): View
    {
        $artist = $request->user();
        $artworkTypes = ArtworkType::all();

        return view('artwork.create', compact('artist', 'artworkTypes'));
    }

    public function index(): View
    {
        $artworks = Artwork::with('artist', 'artworkType')->get();

        return view('artwork.index', compact('artworks'));
    }

    public function store(StoreArtworkRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $path = $request->file('filepath')->store('artworks', 'public');

        $user = $request->user();
        $artist = Artist::where('idUser', $user->idUser)->firstOrFail();

        Artwork::create([
            'idArtist' => $artist->idArtist,
            'art_Title' => $validated['art_Title'],
            'art_Description' => $validated['art_Description'],
            'art_creation_date' => $validated['art_creation_date'],
            'art_Visible' => $validated['art_Visible'],
            'filepath' => $path,
            'art_quantity' => $validated['art_quantity'],
            'idArtworkType' => $validated['idArtworkType'],
            'art_Status' => 'pending',
        ]);

        return redirect()->route('portfolio')->with('success', 'Artwork added successfully');
    }

    public function edit(int $id): View
    {
        $artwork = Artwork::findOrFail($id);
        $artworkTypes = ArtworkType::all();

        return view('artwork.edit', compact('artwork', 'artworkTypes'));
    }

    public function update(UpdateArtworkRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();
        $artwork = Artwork::findOrFail($id);

        $artwork->art_Title = $validated['art_Title'];
        $artwork->art_Description = $validated['art_Description'];
        $artwork->art_creation_date = $validated['art_creation_date'];
        $artwork->art_Visible = $validated['art_Visible'];
        $artwork->art_quantity = $validated['art_quantity'];
        $artwork->idArtworkType = $validated['idArtworkType'];

        if ($request->hasFile('filepath') && $request->file('filepath')->isValid()) {
            if ($artwork->filepath && Storage::disk('public')->exists($artwork->filepath)) {
                Storage::disk('public')->delete($artwork->filepath);
            }

            $artwork->filepath = $request->file('filepath')->store('artworks', 'public');
        }

        $artwork->save();

        return redirect()->route('portfolio', $artwork->idArtist)->with('success', 'Artwork updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $artwork = Artwork::findOrFail($id);

        if ($artwork->filepath && Storage::disk('public')->exists($artwork->filepath)) {
            Storage::disk('public')->delete($artwork->filepath);
        }

        $artwork->delete();

        return redirect()->route('portfolio')->with('success', 'Artwork deleted successfully');
    }

    public function showAddToMarket(int $idArt): View|RedirectResponse
    {
        $artwork = Artwork::findOrFail($idArt);

        if ($artwork->art_Status !== 'Active') {
            return redirect()->route('portfolio')
                ->with('error', 'You can\'t add this artwork because it was not accepted by an admin');
        }

        return view('artwork.showAddToMarket', compact('artwork'));
    }

    public function addToMarket(Request $request, int $idArt): RedirectResponse
    {
        $request->validate([
            'item_price' => 'required|numeric|min:0',
            'quantity_for_sale' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if (!$artist) {
            return redirect()->back()->with('error', 'Artist not found for the authenticated user');
        }

        $existingItem = ShopList::where('idArt', $idArt)
            ->where('idArtist', $artist->idArtist)
            ->exists();

        if ($existingItem) {
            return redirect()->back()->with('error', 'Artwork is already in the market.');
        }

        $artwork = Artwork::findOrFail($idArt);

        if ($request->quantity_for_sale > $artwork->art_quantity) {
            return redirect()->back()->with('error', 'Quantity for sale cannot exceed the available artwork quantity');
        }

        $shopList = new ShopList();
        if (!$shopList->checkQuantityForSale($artist->idArtist)) {
            return redirect()->back()->with('error', 'Quantity for sale cannot exceed the available artwork quantity across all shop list items');
        }

        ShopList::create([
            'idArt' => $idArt,
            'idArtist' => $artist->idArtist,
            'item_price' => $request->item_price,
            'quantity_for_sale' => $request->quantity_for_sale,
        ]);

        return redirect()->route('portfolio')->with('success', 'Artwork added to market successfully');
    }

    public function removeFromMarket(int $id): RedirectResponse
    {
        $user = Auth::user();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if (!$artist) {
            return redirect()->back()->with('error', 'Artist not found for the authenticated user');
        }

        $deletedItem = ShopList::where('idArt', $id)
            ->where('idArtist', $artist->idArtist)
            ->delete();

        if ($deletedItem === 0) {
            return redirect()->back()->with('error', 'Artwork is not in the market.');
        }

        return redirect()->route('portfolio')->with('success', 'Artwork removed from market successfully');
    }

    public function viewOne(int $id): View
    {
        $artwork = Artwork::with('artist', 'artworkType')->where('idArt', $id)->firstOrFail();

        return view('home.artwork', compact('artwork'));
    }

    public function createArtwork(Request $request): RedirectResponse
    {
        $request->validate([
            'filepath' => 'required|image|max:2048',
            'art_Title' => 'required|string|max:50',
            'art_Description' => 'required|string|max:512',
            'art_creation_date' => 'required|date',
            'art_quantity' => 'required|integer|min:1',
            'artist_id' => 'required|exists:artist,idArtist',
            'type' => 'required|string',
        ]);

        $filePath = $request->file('filepath')->store('artworks', 'public');

        $artist = Artist::findOrFail($request->input('artist_id'));

        $idArtworkType = ArtworkType::getIdByTypeName($request->input('type'));

        if (!$idArtworkType) {
            return redirect()->back()->with('error', 'Artwork type not found.');
        }

        Artwork::create([
            'art_Title' => $request->input('art_Title'),
            'art_Description' => $request->input('art_Description'),
            'art_creation_date' => $request->input('art_creation_date'),
            'art_Visible' => $request->boolean('art_Visible'),
            'art_Status' => $request->input('art_Status', 'pending'),
            'idArtist' => $artist->idArtist,
            'idArtworkType' => $idArtworkType,
            'filepath' => $filePath,
            'art_quantity' => $request->input('art_quantity'),
        ]);

        return redirect()->route('adminPanel')->with('success', 'Artwork created successfully.');
    }
}
