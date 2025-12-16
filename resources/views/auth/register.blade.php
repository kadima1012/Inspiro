<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="user_first_name" :value="__('First Name')" />
            <x-text-input id="user_first_name" class="block mt-1 w-full" type="text" name="user_first_name" :value="old('user_first_name')" required autofocus />
            <x-input-error :messages="$errors->get('user_first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="user_last_name" :value="__('Last Name')" />
            <x-text-input id="user_last_name" class="block mt-1 w-full" type="text" name="user_last_name" :value="old('user_last_name')" required />
            <x-input-error :messages="$errors->get('user_last_name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="user_username" :value="__('Username')" />
            <x-text-input id="user_username" class="block mt-1 w-full" type="text" name="user_username" :value="old('user_username')" required />
            <x-input-error :messages="$errors->get('user_username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Birthdate -->
        <div class="mt-4">
            <x-input-label for="user_birthdate" :value="__('Birthdate')" />
            <x-text-input id="user_birthdate" class="block mt-1 w-full" type="date" name="user_birthdate" :value="old('user_birthdate')" required />
            <x-input-error :messages="$errors->get('user_birthdate')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900">Already registered?</a>

            <x-primary-button class="ml-4">Register</x-primary-button>
        </div>
    </form>
</x-guest-layout>
