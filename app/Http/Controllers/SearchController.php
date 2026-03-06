<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function search(Request $request): View
    {
        $query = $request->input('query');

        $results = User::when($query, function ($q, $search) {
            $q->where('user_username', 'like', "%{$search}%");
        })->paginate(10);

        return view('search.search', compact('results', 'query'));
    }

    public function searchList(Request $request): JsonResponse
    {
        $query = $request->input('query');

        $results = User::where('user_username', 'like', "%{$query}%")
            ->get(['user_username', 'email']);

        return response()->json($results);
    }
}
