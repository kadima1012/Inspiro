<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShopList;
use App\Models\ArtworkType;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showProfile($username)
    {
        // You can fetch the user data from the database using the username
        $user = User::where('user_username', $username)->firstOrFail();

        // Pass the user data to the view
        return view('user.profile', compact('user'));
    }

    public function showGallery($username)
    {
        // You can fetch the user data from the database using the username
        $user = User::where('user_username', $username)->firstOrFail();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if($artist){
            $idArtist = $artist->idArtist;
            $artworks = Artwork::where('art_Visible', '1')
                                ->where('idArtist', $idArtist)
                                ->get();
            return view('user.gallery', compact('artworks', 'user'));
        }else{
            return view('user.notAnArtist', compact('user'));
        }
    }

    public function showShop($username, Request $request)
    {
        $artworkTypes = ArtworkType::all();
        $query = ShopList::query();

        // You can fetch the user data from the database using the username
        $user = User::where('user_username', $username)->firstOrFail();
        $artist = Artist::where('idUser', $user->idUser)->firstOrFail();

        if($request){
            $type = $request->input('type');
        }

        if ($type) {
            $query->whereHas('artwork', function ($q) use ($type) {
                $q->where('idArtworkType', $type);
            })->where('idArtist', $artist->idArtist);
        }
        else {
            $query->where('idArtist', $artist->idArtist);
        }

        $shopItems = $query->get();

        if (auth()->check()) {
            $userId = auth()->id();
        } else {
            $userId = null;
        }

        return view('user.shop', compact('shopItems', 'artworkTypes', 'userId', 'user'));
    }

    public function index()
    {
        $users = User::all();
        return view('dashboard.adminPanel', compact('users'));
    }

    public function deleteSelectedUsers(Request $request)
    {
        $selectedUsers = $request->input('selectedUsers');

        User::whereIn('id', $selectedUsers)->delete();

        return response()->json(['message' => 'Utilizatorii selectați au fost șterși cu succes.']);
    }

    public function create(Request $request)
    {
        Log::info('Create user request received', $request->all());

        try {
            $validatedData = $request->validate([
                'user_first_name' => 'required|string|max:255',
                'user_last_name' => 'required|string|max:255',
                'user_username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'user_birthdate' => 'required|date',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string|in:admin,editor,user,artist',
            ]);
            Log::info('Validation passed', $validatedData);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors());
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['user_status'] = 1;

        try {
            $user = User::create($validatedData);
            Log::info('User created successfully', ['user' => $validatedData]);

            $role = Role::where('name', $validatedData['role'])->firstOrFail();
            $user->assignRole($role);

            DB::table('model_has_roles')->insert([
                'role_id' => $role->id,
                'model_type' => get_class($user),
                'model_id' => $user->getKey(),
            ]);

        if ($validatedData['role'] === 'artist' || in_array($validatedData['role'], ['admin', 'editor'])) {
            Artist::createForUser($user);
        }

        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage(), ['data' => $validatedData]);
            return redirect()->back()->with('error', 'There was an error creating the user.');
        }

        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function assignTheRole(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($userId);

        $roleName = $request->input('role');

        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $role = new Role();
            $role->name = $roleName;
            $role->save();
        }

        if ($user->roles->count() > 0) {
            $user->roles()->sync([$role->id]);
        } else {
            $user->roles()->attach($role->id);
        }

        return response()->json([
            'success' => true,
            'message' => 'Role assigned successfully.',
        ]);
    }

}
