<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- Artwork Image -->
                    <div class="aspect-square lg:aspect-auto">
                        <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Artwork Info -->
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <div class="mb-6">
                            <p class="text-amber-600 font-semibold text-sm uppercase tracking-wider mb-2">Artwork</p>
                            <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">{{ $artwork->art_Title }}</h1>
                            <p class="text-lg text-amber-600 font-medium">
                                by {{ $artwork->artist->artist_first_name }} {{ $artwork->artist->artist_last_name }}
                            </p>
                        </div>

                        <div class="border-t border-slate-200 pt-6">
                            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-3">Description</h3>
                            <p class="text-slate-700 leading-relaxed">{{ $artwork->art_Description }}</p>
                        </div>

                        <div class="mt-8">
                            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-amber-600 font-medium transition-colors duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
