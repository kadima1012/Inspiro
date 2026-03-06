<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Basket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($orders->isEmpty())
                <div class="text-center py-20 bg-white rounded-xl shadow-lg">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    <h3 class="text-lg font-semibold text-slate-500">Your basket is empty</h3>
                    <p class="text-slate-400 mt-1 mb-6">Browse the shop to find artwork you love.</p>
                    <a href="{{ route('shop') }}" class="inline-block bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-6 py-2.5 rounded-lg text-sm transition-all duration-300">
                        Browse Shop
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6 border-b border-slate-100">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div>
                                        <span class="text-sm text-slate-500">Order #{{ $order->idOrder }}</span>
                                        <span class="inline-block ml-2 text-xs font-medium px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-800">{{ $order->order_status }}</span>
                                    </div>
                                    <span class="text-xl font-bold text-slate-900">Total: {{ $order->total() }} &euro;</span>
                                </div>
                                @if($order->order_details)
                                    <p class="text-sm text-slate-500 mt-1">{{ $order->order_details }}</p>
                                @endif
                            </div>

                            <div class="p-6">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($order->artworks as $artwork)
                                        <div class="border border-slate-200 rounded-xl overflow-hidden">
                                            <a href="{{ route('home.artwork', ['id' => $artwork->idArt]) }}" class="block aspect-[4/3] overflow-hidden">
                                                <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy">
                                            </a>
                                            <div class="p-4">
                                                <h4 class="font-semibold text-slate-900 text-sm">{{ $artwork->art_Title }}</h4>
                                                <div class="flex justify-between items-center mt-2 text-sm">
                                                    <span class="text-slate-500">Qty: {{ $artwork->quantity_to_order }}</span>
                                                    <span class="font-bold text-slate-900">{{ $artwork->shopItem()->item_price * $artwork->quantity_to_order }} &euro;</span>
                                                </div>
                                                <form action="{{ route('cancel.add.to.basket') }}" method="POST" class="mt-3">
                                                    @csrf
                                                    <input type="hidden" name="idArt" value="{{ $artwork->idArt }}">
                                                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-medium py-2 rounded-lg text-xs transition-all duration-300">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                                <form action="{{ route('confirmOrder') }}" method="POST" class="flex justify-end">
                                    @csrf
                                    <input type="hidden" name="idOrder" value="{{ $order->idOrder }}">
                                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-6 py-2.5 rounded-lg text-sm transition-all duration-300">
                                        Confirm Order
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
