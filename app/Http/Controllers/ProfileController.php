<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Artist;
use App\Models\User;
use App\Models\ShopList;
//use App\Models\Role;
use Carbon\Carbon;
use App\Models\Artwork;
use App\Models\Order;
use App\Models\OrderArtwork;
use Spatie\Permission\Models\Role;



use Illuminate\Support\Facades\DB;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        $artist = Artist::where('idUser', $user->idUser)->first();

        if($artist){
            return redirect()->back()->with('error', 'You cannot delete your account while it is linked to an artist profile. Please cancel the artist profile first.');
        }

        Auth::logout();

        // Check if there are related records in `lives` table
        DB::table('lives')->where('idUser', $user->idUser)->delete();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function becomeArtist(Request $request): RedirectResponse
    {
        if ($request->user()->hasRole('user')) {
            $request->validateWithBag('artistStatus', [
                'password' => ['required', 'current_password'],
            ]);

            if (!Auth::attempt(['email' => $request->user()->email, 'password' => $request->password])) {
                return back()->withErrors(['password' => __('The provided password is incorrect.')]);
            }

            $user = $request->user();

            $user->assignRole('artist');

            $user->update([
                'user_became_artist' => 1,
                'user_became_artist_date' => Carbon::now(),
            ]);

            Artist::createForUser($user);

            return Redirect::route('profile.edit')->with('status', 'You have successfully become an artist!');
        } else {
            return Redirect::route('profile.edit')->with('status', 'You already have artist rights');
        }
    }


    public function cancelArtist(Request $request)
    {
        $idUser = auth()->id();
        $artist = Artist::where('idUser', $idUser)->firstOrFail();

        // Fetch orders that are not received
        $orders = Order::where('idArtist', $artist->idArtist)
                    ->where(function($query) {
                            $query->where('order_status', '!=', 'Received')
                                ->orWhereNull('order_status');
                        })
                    ->where(function($query) {
                        $query->where('order_status', '!=', 'in cart')
                            ->orWhereNull('order_status');
                    })
                    ->with(['artworks' => function ($query) {
                            $query->select('artwork.idArt', 'art_Title', 'art_Description', 'art_quantity', 'quantity_to_order', 'filepath');
                        }])
                    ->get();

        // Determine the message and view to display
        if ($orders->isNotEmpty()) {
            return view('profile.cancel-artist', [
                'orders' => $orders,
                'hasPendingOrders' => true
            ]);
        }

        return view('profile.cancel-artist', [
            'hasPendingOrders' => false
        ]);
    }

    public function confirmCancelArtist(Request $request)
    {
        $user = auth()->user();
        $artist = Artist::where('idUser', $user->idUser)->firstOrFail();

        // Fetch orders associated with the artist
        $orders = Order::where('idArtist', $artist->idArtist)->get();

        // Delete orders
        foreach ($orders as $order) {
            // Delete the order itself
            $order->delete();
        }

        // Delete Shop Item
        DB::table('shop_list')
            ->where('idArtist', $artist->idArtist)
            ->delete();

        // Fetch artworks associated with the artist
        $artworks = Artwork::where('idArtist', $artist->idArtist)->get();

        // Delete artworks first
        foreach ($artworks as $artwork) {
            $artwork->delete();
        }

        // Delete the artist profile and related data
        $artist->delete();

        $user->assignRole('user');

        return redirect()->route('profile.edit')->with('success', 'Your artist profile has been successfully canceled.');
    }


    public function adminPanel()
    {
        $users = User::paginate(10);
        $pendingArtworks = Artwork::where('art_Status', 'Pending')->get();
        $artists = Artist::paginate(10);
        $artworks = Artwork::paginate(10);
        $roles = Role::all();
        $shoplists = ShopList::paginate(10);
        $orders = Order::paginate(10);

        return view('dashboard.admin.adminPanel', compact('users', 'pendingArtworks', 'artists', 'artworks', 'shoplists', 'orders'));
    }




}
