<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Order;
use App\Models\ShopList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $artist = Artist::where('idUser', $user->idUser)->first();

        if ($artist) {
            return redirect()->back()
                ->with('error', 'You cannot delete your account while it is linked to an artist profile. Please cancel the artist profile first.');
        }

        Auth::logout();

        DB::table('lives')->where('idUser', $user->idUser)->delete();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function becomeArtist(Request $request): RedirectResponse
    {
        if (!$request->user()->hasRole('user')) {
            return Redirect::route('profile.edit')->with('status', 'You already have artist rights');
        }

        $request->validateWithBag('artistStatus', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $user->assignRole('artist');

        $user->update([
            'user_became_artist' => 1,
            'user_became_artist_date' => Carbon::now(),
        ]);

        Artist::createForUser($user);

        return Redirect::route('profile.edit')->with('status', 'You have successfully become an artist!');
    }

    public function cancelArtist(Request $request): View
    {
        $idUser = auth()->id();
        $artist = Artist::where('idUser', $idUser)->firstOrFail();

        $orders = Order::where('idArtist', $artist->idArtist)
            ->where(function ($query) {
                $query->where('order_status', '!=', 'Received')
                    ->orWhereNull('order_status');
            })
            ->where(function ($query) {
                $query->where('order_status', '!=', Order::STATUS_IN_CART)
                    ->orWhereNull('order_status');
            })
            ->with(['artworks' => function ($query) {
                $query->select('artwork.idArt', 'art_Title', 'art_Description', 'art_quantity', 'quantity_to_order', 'filepath');
            }])
            ->get();

        if ($orders->isNotEmpty()) {
            return view('profile.cancel-artist', [
                'orders' => $orders,
                'hasPendingOrders' => true,
            ]);
        }

        return view('profile.cancel-artist', [
            'hasPendingOrders' => false,
        ]);
    }

    public function confirmCancelArtist(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $artist = Artist::where('idUser', $user->idUser)->firstOrFail();

        DB::transaction(function () use ($user, $artist) {
            Order::where('idArtist', $artist->idArtist)->delete();

            DB::table('shop_list')
                ->where('idArtist', $artist->idArtist)
                ->delete();

            Artwork::where('idArtist', $artist->idArtist)->delete();

            $artist->delete();

            $user->assignRole('user');
        });

        return redirect()->route('profile.edit')->with('success', 'Your artist profile has been successfully canceled.');
    }

    public function adminPanel(): View
    {
        $users = User::paginate(10);
        $pendingArtworks = Artwork::pending()->get();
        $artists = Artist::paginate(10);
        $artworks = Artwork::paginate(10);
        $roles = Role::all();
        $shoplists = ShopList::paginate(10);
        $orders = Order::paginate(10);

        return view('dashboard.admin.adminPanel', compact(
            'users',
            'pendingArtworks',
            'artists',
            'artworks',
            'shoplists',
            'orders'
        ));
    }
}
