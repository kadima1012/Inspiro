<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                @forelse($conversations as $conversation)
                    @php
                        $otherUser = $conversation->idUser == auth()->id() ? $conversation->otherUser : $conversation->user;
                        $lastMessage = $conversation->messages->last();
                    @endphp
                    <a href="{{ route('messages.show', $conversation->Id_Conversation) }}" class="block p-5 hover:bg-slate-50 transition-colors duration-200 border-b border-slate-100 last:border-b-0">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                <span class="text-amber-700 font-bold text-lg">{{ strtoupper(substr($otherUser->user_first_name ?? 'U', 0, 1)) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-slate-900">{{ $otherUser->user_first_name ?? 'Unknown' }} {{ $otherUser->user_last_name ?? '' }}</h3>
                                <p class="text-sm text-slate-500 truncate">
                                    @if($lastMessage)
                                        {{ Str::limit($lastMessage->message_content, 60) }}
                                    @else
                                        No messages yet
                                    @endif
                                </p>
                            </div>
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-16">
                        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <h3 class="text-lg font-semibold text-slate-500">No conversations yet</h3>
                        <p class="text-slate-400 mt-1">Start a conversation by visiting an artist's profile.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
