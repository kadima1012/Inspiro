<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-slate-900">
            {{ __('Become an Artist') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('By becoming an artist, you will gain access to additional features and be able to showcase your work.') }}
        </p>
    </header>

    <div class="flex flex-wrap gap-3 items-center">
        <x-primary-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-artist-status')"
        >{{ __('Become an Artist') }}</x-primary-button>

        @if($user->hasRole('artist'))
        <form method="post" action="{{ route('cancel.artist') }}">
            @csrf
            <x-danger-button type="submit">{{ __('Cancel Artist') }}</x-danger-button>
        </form>
        @endif
    </div>

    <x-modal name="confirm-artist-status" :show="$errors->artistStatus->isNotEmpty()" focusable>
        <form method="post" action="{{ route('become.artist') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-bold text-slate-900">
                {{ __('Are you sure you want to become an artist?') }}
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ __('By confirming, your account will be upgraded to artist status.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->artistStatus->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-primary-button>{{ __('Become an Artist') }}</x-primary-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="confirm-cancel-artist" :show="$errors->artistStatus->isNotEmpty()" focusable>
        <form method="post" action="{{ route('cancel.artist') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-bold text-slate-900">
                {{ __('Are you sure you want to cancel your artist rights?') }}
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ __('By confirming, your artist rights will be revoked.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->artistStatus->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-primary-button>{{ __('Confirm') }}</x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
