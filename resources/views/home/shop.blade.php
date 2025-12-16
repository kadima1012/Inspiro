<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter by Artwork Type -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Filter by Artwork Type</h3>
                <div class="flex space-x-4">
                    <a href="{{ route('shop') }}" class="px-4 py-2 bg-red-600 text-white rounded">
                        All
                    </a>
                    @foreach($artworkTypes as $type)
                        <a href="{{ route('shop', ['type' => $type->idArtworkType]) }}" class="px-4 py-2 bg-red-600 text-white rounded">
                            {{ $type->type_name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Artwork Grid -->
            <div class="grid grid-cols-3 gap-4">
            @foreach($shopItems as $item)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg gallery-img-container h-60">
                    <div class="p-6 text-gray-900">
                        <p class="font-semibold">{{ $item->artwork->art_Title }}</p>
                        <p class="artist-name">{{ $item->artwork->artist->artist_first_name }} {{ $item->artwork->artist->artist_last_name }}</p>
                        <p class="price">Price: {{ $item->item_price }} &euro;</p>
                        <p class="quantity_sale">Quantity for sale: {{ $item->quantity_for_sale }}</p>
                        @if ($item->artwork->artist->idUser!== $userId)
                            <form action="{{ route('showConfirmAddToBasket', $item->artwork->idArt) }}" method="GET">
                                <button type="submit" class="mt-2 bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Add to basket
                                </button>
                            </form>
                        @else
                            <p class="text-red-600">This is your own work.</p>
                        @endif
                    </div>
                    <a href="{{ route('home.artwork', ['id' => $item->artwork->idArt]) }}">
                        <img src="{{ \App\Helpers\StorageHelper::customUrl($item->artwork->filepath) }}" alt="{{ $item->artwork->art_Title }}" class="mt-2 rounded-lg w-full h-full object-cover">
                    </a>                </div>
            @endforeach


            </div>
        </div>
    </div>
</x-app-layout>
