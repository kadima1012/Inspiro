<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;
use App\Models\User;

class SearchController extends Controller
{
    public function index($username)
    {
        return view('search.search');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform search for users based on the "name" column and paginate results
        $results = User::where('user_username', 'like', '%' . $query . '%')
                       ->paginate(10); // Adjust the number 10 to your preferred items per page

        return view('search.search', compact('results', 'query'));
    }

    public function searchList(Request $request)
    {
        $query = $request->input('query');

        $results = User::where('user_username', 'like', '%' . $query . '%')->get();

        $formattedResults = $results->map(function ($user) {
            return [
                'user_username' => $user->user_username,
                'email' => $user->email,
            ];
        });

        return response()->json($formattedResults);
    }
}
