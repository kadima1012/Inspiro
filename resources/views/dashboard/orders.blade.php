<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($orders->isEmpty())
                <div class="text-center py-20 bg-white rounded-xl shadow-lg">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <h3 class="text-lg font-semibold text-slate-500">No orders yet</h3>
                    <p class="text-slate-400 mt-1">Your order history will appear here.</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="p-6 border-b border-slate-100">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm font-medium text-slate-700">Order #{{ $order->idOrder }}</span>
                                        @php
                                            $statusColors = [
                                                'Active' => 'bg-emerald-100 text-emerald-800',
                                                'Pending' => 'bg-amber-100 text-amber-800',
                                                'Sent' => 'bg-blue-100 text-blue-800',
                                                'Received' => 'bg-emerald-100 text-emerald-800',
                                                'In Cart' => 'bg-slate-100 text-slate-800',
                                                'Canceled' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusClass = $statusColors[$order->order_status] ?? 'bg-slate-100 text-slate-800';
                                        @endphp
                                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $statusClass }}">{{ $order->order_status }}</span>
                                    </div>
                                    <span class="text-xl font-bold text-slate-900">{{ $order->total() }} &euro;</span>
                                </div>
                                @if($order->order_details)
                                    <p class="text-sm text-slate-500 mt-1">{{ $order->order_details }}</p>
                                @endif
                            </div>

                            <div class="p-6">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($order->artworks as $artwork)
                                        <div class="flex gap-4 p-3 rounded-xl border border-slate-100">
                                            <a href="{{ route('home.artwork', ['id' => $artwork->idArt]) }}" class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                                <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="w-full h-full object-cover" loading="lazy">
                                            </a>
                                            <div class="min-w-0">
                                                <h4 class="font-semibold text-slate-900 text-sm truncate">{{ $artwork->art_Title }}</h4>
                                                <p class="text-xs text-slate-500 mt-0.5">Qty: {{ $artwork->quantity_to_order }}</p>
                                                <p class="text-sm font-bold text-slate-900 mt-1">{{ $artwork->shopItem()->item_price * $artwork->quantity_to_order }} &euro;</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @if($order->order_status == 'Sent')
                                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                                    <form action="{{ route('received') }}" method="POST" class="flex justify-end">
                                        @csrf
                                        <input type="hidden" name="idOrder" value="{{ $order->idOrder }}">
                                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition-all duration-300">
                                            Mark as Received
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
