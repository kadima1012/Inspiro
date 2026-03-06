<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Add Artwork to Market') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- Artwork Preview -->
                    <div class="p-6 lg:p-8">
                        <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="w-full rounded-xl object-cover">
                    </div>

                    <!-- Details & Form -->
                    <div class="p-6 lg:p-8 flex flex-col justify-center">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ $artwork->art_Title }}</h3>
                            <p class="text-slate-600 text-sm mb-2">{{ $artwork->art_Description }}</p>
                            <p class="text-slate-400 text-xs">Created: {{ $artwork->art_creation_date }}</p>
                        </div>

                        <form action="{{ route('artwork.addToMarket', $artwork->idArt) }}" method="POST" class="space-y-5">
                            @csrf

                            <div>
                                <label for="item_price" class="block text-sm font-medium text-slate-700 mb-1">Price (EUR)</label>
                                <input id="item_price" type="number" step="0.01" min="0" max="99999999.99" name="item_price" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                            </div>

                            <div>
                                <label for="quantity_for_sale" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Quantity for Sale') }}</label>
                                <input id="quantity_for_sale" type="number" name="quantity_for_sale" min="1" max="{{ $artwork->art_quantity }}" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                                <p class="text-xs text-slate-400 mt-1">Maximum: {{ $artwork->art_quantity }} pieces</p>
                            </div>

                            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold py-3 rounded-lg transition-all duration-300">
                                {{ __('Add to Market') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
