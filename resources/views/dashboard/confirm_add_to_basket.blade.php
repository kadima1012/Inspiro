<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Confirm Add to Basket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <!-- Image -->
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Details -->
                    <div class="p-8 flex flex-col justify-center">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ $artwork->art_Title }}</h3>
                        <p class="text-slate-600 text-sm mb-6">{{ $artwork->art_Description }}</p>

                        <form action="{{ route('add.to.basket.confirm') }}" method="POST" class="space-y-5" x-data="{ qty: 1 }">
                            @csrf
                            <input type="hidden" name="idArt" value="{{ $artwork->idArt }}">
                            <input type="hidden" name="quantity" x-bind:value="qty">

                            <div>
                                <label for="_tquantityo_order" class="block text-sm font-medium text-slate-700 mb-1">Quantity</label>
                                <input type="number" id="quantity_to_order" name="quantity_to_order" x-model="qty" value="1" min="1" max="{{ $artwork->shopItem()->quantity_for_sale }}" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                                <p class="text-xs text-slate-400 mt-1">Available: {{ $artwork->shopItem()->quantity_for_sale }}</p>
                            </div>

                            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold py-3 rounded-lg transition-all duration-300">
                                Yes, Add to Basket
                            </button>

                            <a href="{{ url()->previous() }}" class="block text-center text-slate-500 hover:text-slate-700 text-sm transition-colors duration-300">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
