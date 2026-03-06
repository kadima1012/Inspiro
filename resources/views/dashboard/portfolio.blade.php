<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">{{ __('Portfolio') }}</h2>
            <a href="{{ route('artwork.create') }}" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-4 py-2 rounded-lg text-sm transition-all duration-300">
                + Add Artwork
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Category Filter Pills -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('portfolio', ['category' => 'all']) }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ (!request('category') || request('category') == 'all') ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">All</a>
                    <a href="{{ route('portfolio', ['category' => 'visible']) }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ request('category') == 'visible' ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">Active</a>
                    <a href="{{ route('portfolio', ['category' => 'shop']) }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ request('category') == 'shop' ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">Shop</a>
                    <a href="{{ route('portfolio', ['category' => 'pending']) }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ request('category') == 'pending' ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">Pending</a>
                    <a href="{{ route('portfolio', ['category' => 'declined']) }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ request('category') == 'declined' ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">Declined</a>
                </div>
            </div>

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Artist Info Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $artist->artist_first_name }} {{ $artist->artist_last_name }}</h3>
                        <p class="text-slate-500 text-sm mt-1">{{ $artist->artist_description }}</p>
                        <div class="flex flex-wrap gap-4 mt-3 text-sm text-slate-600">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $artist->artist_email }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $artist->artist_experience }} years experience
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('artist.edit', $artist->idArtist) }}" class="inline-flex items-center gap-2 bg-slate-700 hover:bg-slate-600 text-white font-medium px-4 py-2 rounded-lg text-sm transition-all duration-300 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Artist Info
                    </a>
                </div>
            </div>

            <!-- Artworks Grid -->
            @if($artworks->isEmpty())
                <div class="text-center py-20 bg-white rounded-xl shadow-lg">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <h3 class="text-lg font-semibold text-slate-500">No artworks found</h3>
                    <p class="text-slate-400 mt-1 mb-6">Start building your portfolio by adding your first artwork.</p>
                    <a href="{{ route('artwork.create') }}" class="inline-block bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-6 py-2.5 rounded-lg text-sm transition-all duration-300">
                        + Add Your First Artwork
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($artworks as $artwork)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                            @if($artwork->filepath)
                                <div class="aspect-[4/3] overflow-hidden">
                                    <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="w-full h-full object-cover" loading="lazy">
                                </div>
                            @endif
                            <div class="p-5">
                                <div class="flex items-start justify-between mb-2">
                                    <h4 class="font-bold text-slate-900">{{ $artwork->art_Title }}</h4>
                                    @php
                                        $statusColors = [
                                            'Active' => 'bg-emerald-100 text-emerald-800',
                                            'Pending' => 'bg-amber-100 text-amber-800',
                                            'Declined' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusClass = $statusColors[$artwork->art_Status] ?? 'bg-slate-100 text-slate-800';
                                    @endphp
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $statusClass }}">{{ $artwork->art_Status }}</span>
                                </div>
                                <p class="text-slate-500 text-sm line-clamp-2 mb-2">{{ $artwork->art_Description }}</p>
                                <div class="flex items-center gap-3 text-xs text-slate-400 mb-4">
                                    <span>{{ $artwork->artworkType->type_name }}</span>
                                    <span>{{ $artwork->art_quantity }} pcs</span>
                                    @if($artwork->shopList->isNotEmpty())
                                        <span class="text-amber-600 font-medium">{{ $artwork->shopList->first()->quantity_for_sale }} for sale</span>
                                    @endif
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('artwork.edit', $artwork->idArt) }}" class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2 px-3 rounded-lg text-xs transition-all duration-300">Edit</a>
                                    <form action="{{ route('artwork.destroy', $artwork->idArt) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this artwork?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-medium py-2 px-3 rounded-lg text-xs transition-all duration-300">Delete</button>
                                    </form>
                                    @php
                                        $shopListItem = $artwork->shopList()->where('idArtist', $artist->idArtist)->first();
                                    @endphp
                                    @if($shopListItem)
                                        <form action="{{ route('artwork.removeFromMarket', $artwork->idArt) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full bg-slate-700 hover:bg-slate-600 text-white font-medium py-2 px-3 rounded-lg text-xs transition-all duration-300">Remove from Market</button>
                                        </form>
                                    @else
                                        <a href="{{ route('artwork.showAddToMarket', $artwork->idArt) }}" class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-slate-900 font-medium py-2 px-3 rounded-lg text-xs transition-all duration-300">Add to Market</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
