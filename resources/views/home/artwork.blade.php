<x-app-layout>

    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Artwork') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="p-6 text-gray-900">
                            <p class="font-semibold">{{ $artwork->art_Title }}</p>
                            <p class="artist-name">{{ $artwork->artist->artist_first_name }} {{ $artwork->artist->artist_last_name }}</p>
                        </div>
                        <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}">
                        <div class="p-6 text-gray-900">
                            <p>{{ $artwork->art_Description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
