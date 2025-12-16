<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Artist;
use App\Models\User;
use App\Models\ShopList;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\ArtworkType;
use Illuminate\Support\Facades\Log;

class ArtworkController extends Controller
{
    public function create(Request $request)
    {
        $artist = $request->user();
        $artworkTypes = ArtworkType::all();
        return view('artwork.create', compact('artist', 'artworkTypes'));
    }

    public function index()
    {
        $artworks = Artwork::all();

        return view('artwork.index', compact('artworks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'art_Title' => 'required|string|max:50',
            'art_Description' => 'required|string|max:512',
            'art_creation_date' => 'required|date',
            'art_Visible' => 'required|boolean',
            'filepath' => 'required|image|max:2048',
            'art_quantity' => 'required|integer|min:1',
            'idArtworkType' => 'required|exists:artwork_type,idArtworkType',
        ]);

        $path = $request->file('filepath')->store('artworks', 'public');

        $user=$request->user();
        $artist=Artist::where('idUser', $user->idUser)->FirstOrFail();

        Artwork::create([
            'idArtist' => $artist->idArtist,
            'art_Title' => $request->art_Title,
            'art_Description' => $request->art_Description,
            'art_creation_date' => $request->art_creation_date,
            'art_Visible' => $request->art_Visible,
            'filepath' => $path,
            'art_quantity' => $request->art_quantity,
            'idArtworkType' => $request->idArtworkType,
            'art_Status' => 'pending',
        ]);

        return redirect()->route('portfolio', $request->idArtist)->with('success', 'Artwork added successfully');
    }



    public function edit($id)
    {
        $artwork = Artwork::findOrFail($id);
        $artworkTypes = ArtworkType::all();

        return view('artwork.edit', compact('artwork', 'artworkTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'art_Title' => 'required|string|max:50',
            'art_Description' => 'required|string|max:512',
            'art_creation_date' => 'required|date',
            'art_Visible' => 'required|boolean',
            'art_quantity' => 'required|integer|min:1',
            'filepath' => 'image|max:2048',
            'idArtworkType' => 'required|exists:artwork_type,idArtworkType',
        ]);

        $artwork = Artwork::findOrFail($id);
        $artwork->art_Title = $request->art_Title;
        $artwork->art_Description = $request->art_Description;
        $artwork->art_creation_date = $request->art_creation_date;
        $artwork->art_Visible = $request->art_Visible;
        $artwork->art_quantity = $request->art_quantity;
        $artwork->idArtworkType = $request->idArtworkType;

        if ($request->hasFile('filepath') && $request->file('filepath')->isValid()) {
            $path = $request->file('filepath')->store('artworks', 'public');
            $artwork->filepath = $path;
        }

        $artwork->save();

        return redirect()->route('portfolio', $artwork->idArtist)->with('success', 'Artwork updated successfully');
    }




    public function destroy($id)
    {
        $artwork = Artwork::findOrFail($id);
        $artwork->delete();

        return redirect()->route('portfolio')->with('success', 'Artwork deleted successfully');
    }


    public function showAddToMarket($idArt)
    {
        $artwork = Artwork::findOrFail($idArt);

        if ($artwork->art_Status !== 'Active') {
            return redirect()->route('portfolio')->with('error', 'You can\'t add this artwork because it was not accepted by an admin');
        }

        return view('artwork.showAddToMarket', compact('artwork'));
    }




    public function addToMarket(Request $request, $idArt)
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


    public function removeFromMarket($id)
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

    public function viewOne($id){
        $artwork = Artwork::where('idArt', $id)->firstOrFail();
        return view('home.artwork', compact('artwork'));
    }

    public function createArtwork(Request $request)
    {
        if ($request->hasFile('filepath')) {
            $file = $request->file('filepath');

            $filePath = $file->store('artworks');
        } else {
            return redirect()->back()->with('error', 'Please upload a file.');
        }

        $artistId = $request->input('artist_id');

        $artist = Artist::find($artistId);

        if (!$artist) {
            return redirect()->back()->with('error', 'Artist not found.');
        }

        $typeName = $request->input('type');
        $idArtworkType = ArtworkType::getIdByTypeName($typeName);

        if (!$idArtworkType) {
            return redirect()->back()->with('error', 'Artwork type not found.');
        }

        $artwork = new Artwork();
        $artwork->art_Title = $request->input('art_Title');
        $artwork->art_Description = $request->input('art_Description');
        $artwork->art_creation_date = $request->input('art_creation_date');
        $artwork->art_Visible = $request->input('art_Visible') ? true : false;
        $artwork->art_Status = $request->input('art_Status');
        $artwork->idArtist = $artistId;
        $artwork->idArtworkType = $idArtworkType;
        $artwork->filepath = $filePath;
        $artwork->art_quantity = $request->input('art_quantity');

        $artwork->save();

        return redirect()->route('adminPanel')->with('success', 'Artwork created successfully.');
    }
}

