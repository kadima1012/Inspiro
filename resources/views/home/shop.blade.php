<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter by Artwork Type -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('shop') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ !request('type') ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">
                        All
                    </a>
                    @foreach($artworkTypes as $type)
                        <a href="{{ route('shop', ['type' => $type->idArtworkType]) }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ request('type') == $type->idArtworkType ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">
                            {{ $type->type_name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Artwork Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($shopItems as $item)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
                        <a href="{{ route('home.artwork', ['id' => $item->artwork->idArt]) }}" class="block aspect-[4/3] overflow-hidden">
                            <img src="{{ \App\Helpers\StorageHelper::customUrl($item->artwork->filepath) }}" alt="{{ $item->artwork->art_Title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        </a>
                        <div class="p-4">
                            <h3 class="font-semibold text-slate-900">{{ $item->artwork->art_Title }}</h3>
                            <p class="text-sm text-amber-600 font-medium mt-1">{{ $item->artwork->artist->artist_first_name }} {{ $item->artwork->artist->artist_last_name }}</p>

                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xl font-bold text-slate-900">{{ $item->item_price }} &euro;</span>
                                <span class="text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded-full">{{ $item->quantity_for_sale }} available</span>
                            </div>

                            <div class="mt-4">
                                @if ($item->artwork->artist->idUser !== $userId)
                                    <form action="{{ route('showConfirmAddToBasket', $item->artwork->idArt) }}" method="GET">
                                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 text-sm">
                                            Add to Basket
                                        </button>
                                    </form>
                                @else
                                    <p class="text-sm text-slate-400 text-center py-2">Your own artwork</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($shopItems->isEmpty())
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    <h3 class="text-lg font-semibold text-slate-500">No items for sale</h3>
                    <p class="text-slate-400 mt-1">Check back later for new items.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
