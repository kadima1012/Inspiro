<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Artwork Type Filter -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('gallery') }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ !request('type') ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">
                        All
                    </a>
                    @foreach($artworkTypes as $type)
                        <a href="{{ route('gallery', ['type' => $type->idArtworkType]) }}" class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ request('type') == $type->idArtworkType ? 'bg-amber-500 text-slate-900' : 'bg-white text-slate-700 hover:bg-amber-100 border border-slate-200' }}">
                            {{ $type->type_name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Artwork Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($artworks as $artwork)
                    <a href="{{ route('home.artwork', ['id' => $artwork->idArt]) }}" class="group block bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="aspect-[4/3] overflow-hidden">
                            <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-slate-900 group-hover:text-amber-600 transition-colors duration-300">{{ $artwork->art_Title }}</h3>
                            <p class="text-sm text-amber-600 font-medium mt-1">{{ $artwork->artist->artist_first_name }} {{ $artwork->artist->artist_last_name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($artworks->isEmpty())
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <h3 class="text-lg font-semibold text-slate-500">No artworks found</h3>
                    <p class="text-slate-400 mt-1">Try selecting a different filter or check back later.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
