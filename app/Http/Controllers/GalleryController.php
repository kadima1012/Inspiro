<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\ArtworkType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $artworkTypeId = $request->query('type');
        $artworkTypes = ArtworkType::all();

        $artworks = Artwork::visible()
            ->active()
            ->when($artworkTypeId, function ($query, $typeId) {
                $query->where('idArtworkType', $typeId);
            })
            ->with('artist')
            ->get();

        return view('home.gallery', compact('artworks', 'artworkTypes', 'artworkTypeId'));
    }

    public function pending(): View
    {
        $pendingArtworks = Artwork::pending()->with('artist')->get();

        return view('dashboard.pending', compact('pendingArtworks'));
    }
}
