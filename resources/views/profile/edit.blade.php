<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    @if (session('error'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="text-red-600 text-xl text-center">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

    @if (session('success'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="text-red-600 text-xl text-center">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    @if (session('status'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="text-red-600 text-xl text-center">
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.become-artist-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
