<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Cancel Artist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($hasPendingOrders)
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Cannot Cancel Artist Profile</h3>
                            <p class="text-slate-600 mt-1">You have pending orders that have not been received yet. Please resolve these orders before canceling your artist profile.</p>
                            <p class="text-slate-500 text-sm mt-2">If you don't want any new orders, remove your artworks from the market.</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6">
                        @foreach ($orders as $order)
                            <div class="border border-slate-200 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-sm font-medium text-slate-700">Order #{{ $order->idOrder }}</span>
                                    @php
                                        $statusColors = [
                                            'Active' => 'bg-emerald-100 text-emerald-800',
                                            'Sent' => 'bg-blue-100 text-blue-800',
                                            'Pending' => 'bg-amber-100 text-amber-800',
                                        ];
                                        $statusClass = $statusColors[$order->order_status] ?? 'bg-slate-100 text-slate-800';
                                    @endphp
                                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $statusClass }}">{{ $order->order_status }}</span>
                                </div>
                                <ul class="text-sm text-slate-500 space-y-1">
                                    @foreach ($order->artworks as $artwork)
                                        <li>{{ $artwork->art_Title }} (Qty: {{ $artwork->quantity_to_order }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 bg-slate-700 hover:bg-slate-600 text-white font-medium px-5 py-2.5 rounded-lg text-sm transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Profile
                    </a>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-12 h-12 bg-red-100 text-red-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Warning</h3>
                            <p class="text-slate-600 mt-1">By canceling your artist profile, all associated data including artworks and orders will be permanently deleted. Are you sure you want to proceed?</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('profile.confirm-cancel-artist') }}" class="flex flex-wrap gap-3">
                        @csrf
                        <a href="{{ route('profile.edit') }}" class="bg-slate-700 hover:bg-slate-600 text-white font-medium px-5 py-2.5 rounded-lg text-sm transition-all duration-300">
                            No, Keep My Profile
                        </a>
                        <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-medium px-5 py-2.5 rounded-lg text-sm transition-all duration-300">
                            Yes, Cancel My Artist Profile
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
