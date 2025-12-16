<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_first_name' => ['required', 'string', 'max:50'],
            'user_last_name' => ['required', 'string', 'max:50'],
            'user_username' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_birthdate' => ['required', 'date'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $userData = $request->only([
            'user_first_name',
            'user_last_name',
            'user_username',
            'email',
            'user_birthdate',
            'password',
        ]);
        $userData['user_status'] = 1;

        $user = User::create([
            'user_first_name' => $userData['user_first_name'],
            'user_last_name' => $userData['user_last_name'],
            'user_username' => $userData['user_username'],
            'email' => $userData['email'],
            'user_status' => $userData['user_status'],
            'user_birthdate' => $userData['user_birthdate'],
            'password' => Hash::make($userData['password']),
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
