<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portfolio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Categories Filter -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Filter by Category</h3>
                <div class="flex space-x-4">
                    <a href="{{ route('portfolio', ['category' => 'all']) }}" class="px-4 py-2 bg-red-600 text-white rounded">
                        All
                    </a>
                    <a href="{{ route('portfolio', ['category' => 'visible']) }}" class="px-4 py-2 bg-red-600 text-white rounded">
                        Visible
                    </a>
                    <a href="{{ route('portfolio', ['category' => 'shop']) }}" class="px-4 py-2 bg-red-600 text-white rounded">
                        Shop
                    </a>
                    <a href="{{ route('portfolio', ['category' => 'pending']) }}" class="px-4 py-2 bg-red-600 text-white rounded">
                        Pending
                    </a>
                    <a href="{{ route('portfolio', ['category' => 'declined']) }}" class="px-4 py-2 bg-red-600 text-white rounded">
                        Declined
                    </a>
                </div>
            </div>

            <!-- Display error message if any -->
            @if (session('error'))
                <div class="mb-4 text-sm text-red-600">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                        {{ __('Artist Information') }}
                    </h3>
                    <ul>
                        <li><strong>ID:</strong> {{ $artist->idArtist }}</li>
                        <li><strong>First Name:</strong> {{ $artist->artist_first_name }}</li>
                        <li><strong>Last Name:</strong> {{ $artist->artist_last_name }}</li>
                        <li><strong>Description:</strong> {{ $artist->artist_description }}</li>
                        <li><strong>Email:</strong> {{ $artist->artist_email }}</li>
                        <li><strong>Portfolio:</strong> <a href="{{ $artist->artist_portofolio }}">{{ $artist->artist_portofolio }}</a></li>
                        <li><strong>Experience:</strong> {{ $artist->artist_experience }} years</li>
                    </ul>
                    <br>
                    <a href="{{ route('artist.edit', $artist->idArtist) }}" class="inline-block bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Edit Artist Information') }}
                    </a>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                        {{ __('Artworks') }}
                    </h3>
                    @if($artworks->isEmpty())
                        <p>{{ __('No artworks found.') }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($artworks as $artwork)
    <div class="bg-gray-100 p-4 rounded-lg shadow">
        <h4 class="font-semibold text-md text-gray-800 leading-tight">{{ $artwork->art_Title }}</h4>
        <p>{{ $artwork->art_Description }}</p>
        <p>{{ $artwork->art_quantity }} pieces</p>
        @if($artwork->filepath)
            <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="mt-2 rounded-lg">
        @endif
        <br>
        <p>Type: {{ $artwork->artworkType->type_name }}</p>

        @if($artwork->shopList->isNotEmpty())
            <p>{{ $artwork->shopList->first()->quantity_for_sale }} pieces for sale</p>
        @else
            <p>0 pieces for sale</p>
        @endif

        <div class="flex justify-between mt-4">
            <a href="{{ route('artwork.edit', $artwork->idArt) }}" class="inline-block bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Edit Artwork') }}
                                        </a>
                                        <form action="{{ route('artwork.destroy', $artwork->idArt) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" x-on:click="showDeleteModal = true" class="inline-block bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                {{ __('Delete Artwork') }}
                                            </button>
                                        </form>
                                        @php
                                            $shopListItem = $artwork->shopList()->where('idArtist', $artist->idArtist)->first();
                                        @endphp
                                        @if($shopListItem)
                                            <form action="{{ route('artwork.removeFromMarket', $artwork->idArt) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="inline-block bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    {{ __('Remove from Market') }}
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('artwork.showAddToMarket', $artwork->idArt) }}" class="inline-block bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                {{ __('Add to Market') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <br>
                    <a href="{{ route('artwork.create') }}" class="inline-block bg-red-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Add Artwork') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
