<x-guest-layout>
    <h2 class="text-2xl font-bold text-slate-900 text-center mb-6">Create Account</h2>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="user_first_name" :value="__('First Name')" />
                <x-text-input id="user_first_name" class="block mt-1 w-full" type="text" name="user_first_name" :value="old('user_first_name')" required autofocus />
                <x-input-error :messages="$errors->get('user_first_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="user_last_name" :value="__('Last Name')" />
                <x-text-input id="user_last_name" class="block mt-1 w-full" type="text" name="user_last_name" :value="old('user_last_name')" required />
                <x-input-error :messages="$errors->get('user_last_name')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-input-label for="user_username" :value="__('Username')" />
            <x-text-input id="user_username" class="block mt-1 w-full" type="text" name="user_username" :value="old('user_username')" required />
            <x-input-error :messages="$errors->get('user_username')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="user_birthdate" :value="__('Birthdate')" />
            <x-text-input id="user_birthdate" class="block mt-1 w-full" type="date" name="user_birthdate" :value="old('user_birthdate')" required />
            <x-input-error :messages="$errors->get('user_birthdate')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3">
            {{ __('Register') }}
        </x-primary-button>

        <p class="text-center text-sm text-slate-500">
            Already have an account?
            <a href="{{ route('login') }}" class="text-amber-600 hover:text-amber-700 font-medium transition-colors duration-300">Log in here</a>
        </p>
    </form>
</x-guest-layout>
