<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\ArtworkType;
use App\Models\ShopList;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function showProfile(string $username): View
    {
        $user = User::where('user_username', $username)->firstOrFail();

        return view('user.profile', compact('user'));
    }

    public function showGallery(string $username): View
    {
        $user = User::where('user_username', $username)->firstOrFail();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if ($artist) {
            $artworks = Artwork::where('art_Visible', 1)
                ->where('idArtist', $artist->idArtist)
                ->get();

            return view('user.gallery', compact('artworks', 'user'));
        }

        return view('user.notAnArtist', compact('user'));
    }

    public function showShop(string $username, Request $request): View
    {
        $artworkTypes = ArtworkType::all();
        $user = User::where('user_username', $username)->firstOrFail();
        $artist = Artist::where('idUser', $user->idUser)->firstOrFail();

        $type = $request->input('type');

        $query = ShopList::query()->where('idArtist', $artist->idArtist);

        if ($type) {
            $query->whereHas('artwork', function ($q) use ($type) {
                $q->where('idArtworkType', $type);
            });
        }

        $shopItems = $query->with('artwork')->get();
        $userId = auth()->id();

        return view('user.shop', compact('shopItems', 'artworkTypes', 'userId', 'user'));
    }

    public function index(): View
    {
        $users = User::all();

        return view('dashboard.adminPanel', compact('users'));
    }

    public function deleteSelectedUsers(Request $request): JsonResponse
    {
        $request->validate([
            'selectedUsers' => 'required|array',
            'selectedUsers.*' => 'integer|exists:users,idUser',
        ]);

        User::whereIn('idUser', $request->input('selectedUsers'))->delete();

        return response()->json(['message' => 'Selected users have been deleted successfully.']);
    }

    public function create(CreateUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $validated['user_status'] = 1;

        try {
            $user = User::create($validated);
            $user->assignRole($validated['role']);

            if (in_array($validated['role'], ['artist', 'admin', 'editor'])) {
                Artist::createForUser($user);
            }
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());

            return redirect()->back()->with('error', 'There was an error creating the user.');
        }

        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function assignTheRole(Request $request, int $userId): JsonResponse
    {
        $request->validate([
            'role' => 'required|string|in:admin,editor,user,artist',
        ]);

        $user = User::findOrFail($userId);
        $roleName = $request->input('role');

        $role = Role::firstOrCreate(['name' => $roleName]);
        $user->roles()->sync([$role->id]);

        return response()->json([
            'success' => true,
            'message' => 'Role assigned successfully.',
        ]);
    }
}
