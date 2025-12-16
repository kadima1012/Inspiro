<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\ArtworkType;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $artworkTypeId = $request->query('type');
        $artworkTypes = ArtworkType::all();

        if ($artworkTypeId) {
            $artworks = Artwork::where('art_Visible', '1')
                               ->where('art_status', 'Active')
                               ->where('idArtworkType', $artworkTypeId)
                               ->get();
        } else {
            $artworks = Artwork::where('art_Visible', '1')
                               ->where('art_status', 'Active')
                               ->get();
        }

        return view('home.gallery', compact('artworks', 'artworkTypes', 'artworkTypeId'));
    }

    public function pending()
    {
        $pendingArtworks = Artwork::where('art_status', 'pending')->get();

        return view('dashboard.pending', compact('pendingArtworks'));
    }
}
