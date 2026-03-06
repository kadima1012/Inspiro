<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Artists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search -->
            <div class="mb-8">
                <form action="{{ route('artists.index') }}" method="GET" class="flex gap-3">
                    <input type="text" name="search" placeholder="Find artists..." value="{{ Request::input('search') }}" class="flex-1 max-w-md rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-6 py-2.5 rounded-lg text-sm transition-all duration-300">Search</button>
                </form>
            </div>

            <!-- Artists Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($artists as $artist)
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 text-center">
                        <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">
                            {{ strtoupper(substr($artist->artist_first_name, 0, 1)) }}{{ strtoupper(substr($artist->artist_last_name, 0, 1)) }}
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $artist->artist_first_name }} {{ $artist->artist_last_name }}</h3>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $artist->artist_description }}</p>
                        <p class="text-xs text-slate-400 mt-2">{{ $artist->artist_experience }} years experience</p>
                        @if($artist->artist_portfolio)
                            <a href="{{ $artist->artist_portfolio }}" class="inline-block mt-4 text-sm text-amber-600 hover:text-amber-700 font-medium transition-colors duration-300">View Portfolio</a>
                        @endif
                    </div>
                @endforeach
            </div>

            @if($artists->isEmpty())
                <div class="text-center py-20 bg-white rounded-xl shadow-lg">
                    <h3 class="text-lg font-semibold text-slate-500">No artists found</h3>
                    <p class="text-slate-400 mt-1">Try a different search term.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
