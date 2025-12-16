<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopList;
use App\Models\ArtworkType;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $artworkTypes = ArtworkType::all();
        $query = ShopList::query();

        if($request){
            $type = $request->input('type');
        }

        if ($type) {
            $query->whereHas('artwork', function ($q) use ($type) {
                $q->where('idArtworkType', $type);
            });
        }

        $shopItems = $query->get();

        if (auth()->check()) {
            $userId = auth()->id();
        } else {
            $userId = null;
        }

        return view('home.shop', compact('shopItems', 'artworkTypes', 'userId'));
    }

}
