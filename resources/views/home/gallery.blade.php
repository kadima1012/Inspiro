<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Gallery') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Artwork Type Filter -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold mb-2">Filter by Artwork Type</h3>
            <div class="flex space-x-4">
                <a href="{{ route('gallery') }}" class="px-4 py-2 bg-red-600 text-white rounded">
                    All
                </a>
                @foreach($artworkTypes as $type)
                    <a href="{{ route('gallery', ['type' => $type->idArtworkType]) }}" class="px-4 py-2 bg-red-600 text-white rounded">
                        {{ $type->type_name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Artwork Grid -->
        <div class="grid grid-cols-3 gap-4">
            @foreach($artworks as $artwork)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg gallery-img-container h-60">
                    <div class="p-6 text-gray-900">
                        <p class="font-semibold">{{ $artwork->art_Title }}</p>
                        <p class="artist-name">{{ $artwork->artist->artist_first_name }} {{ $artwork->artist->artist_last_name }}</p>
                    </div>
                    <a href="{{ route('home.artwork', ['id' => $artwork->idArt]) }}">
                        <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="mt-2 rounded-lg w-full h-full object-cover">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

</x-app-layout>
