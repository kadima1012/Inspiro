<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Image -->
            <div class="relative h-64 sm:h-80 rounded-xl overflow-hidden mb-12">
                <img src="{{ asset('img/images.jpg') }}" alt="Art Events" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <h3 class="text-2xl sm:text-3xl font-bold text-white">Discover Art Events</h3>
                    <p class="text-gray-300 mt-2">Connect with artists and collectors at exhibitions near you</p>
                </div>
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="p-6">
                            <!-- Date Badge -->
                            <div class="inline-flex items-center gap-2 bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-medium mb-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $event->event_date }}
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $event->event_name }}</h3>
                            <p class="text-slate-600 text-sm mb-4 line-clamp-3">{{ $event->event_description }}</p>

                            <!-- Location -->
                            <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $event->event_location }}
                            </div>

                            <!-- Participants -->
                            <div class="flex gap-4 mb-4">
                                <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-xs font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    {{ $event->visitors_count }} Visitors
                                </span>
                                <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-xs font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $event->exhibitors_count }} Exhibitors
                                </span>
                            </div>

                            @auth
                                @php
                                    $isParticipating = $event->participants->where('idUser', auth()->id())->isNotEmpty();
                                @endphp
                                @if($isParticipating)
                                    <form action="{{ route('events.leave', $event->IdEvents) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-slate-200 hover:bg-red-100 text-slate-700 hover:text-red-700 font-semibold py-2.5 rounded-lg transition-all duration-300 text-sm">
                                            Leave Event
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('events.join', $event->IdEvents) }}" method="POST" x-data="{ showOptions: false }">
                                        @csrf
                                        <div class="flex gap-2">
                                            <select name="status" class="flex-1 rounded-lg border-slate-300 text-sm focus:ring-amber-500 focus:border-amber-500">
                                                <option value="Visiting">As Visitor</option>
                                                <option value="Exhibiting">As Exhibitor</option>
                                            </select>
                                            <button type="submit" class="flex-1 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold py-2.5 rounded-lg transition-all duration-300 text-sm">
                                                Join Event
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            @if($events->isEmpty())
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <h3 class="text-lg font-semibold text-slate-500">No events scheduled</h3>
                    <p class="text-slate-400 mt-1">Check back later for upcoming events.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
