<x-guest-layout>
    <h2 class="text-2xl font-bold text-slate-900 text-center mb-2">Confirm Password</h2>
    <p class="text-sm text-slate-500 text-center mb-6">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3">
            {{ __('Confirm') }}
        </x-primary-button>
    </form>
</x-guest-layout>
