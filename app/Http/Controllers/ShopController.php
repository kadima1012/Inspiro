<?php

namespace App\Http\Controllers;

use App\Models\ArtworkType;
use App\Models\ShopList;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $artworkTypes = ArtworkType::all();
        $type = $request->input('type');

        $shopItems = ShopList::query()
            ->when($type, function ($query, $type) {
                $query->whereHas('artwork', function ($q) use ($type) {
                    $q->where('idArtworkType', $type);
                });
            })
            ->with('artwork', 'artist')
            ->get();

        $userId = auth()->id();

        return view('home.shop', compact('shopItems', 'artworkTypes', 'userId'));
    }
}
