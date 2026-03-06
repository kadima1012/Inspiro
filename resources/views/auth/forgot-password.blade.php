<x-guest-layout>
    <h2 class="text-2xl font-bold text-slate-900 text-center mb-2">Forgot Password</h2>
    <p class="text-sm text-slate-500 text-center mb-6">
        {{ __('No problem. Just enter your email address and we will send you a password reset link.') }}
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3">
            {{ __('Email Password Reset Link') }}
        </x-primary-button>

        <p class="text-center text-sm text-slate-500">
            <a href="{{ route('login') }}" class="text-amber-600 hover:text-amber-700 font-medium transition-colors duration-300">Back to Login</a>
        </p>
    </form>
</x-guest-layout>
