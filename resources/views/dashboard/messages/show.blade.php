<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('messages.index') }}" class="text-slate-500 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ $otherUser->user_first_name }} {{ $otherUser->user_last_name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Messages -->
                <div class="p-6 space-y-4 max-h-[500px] overflow-y-auto" id="messages-container">
                    @forelse($messages as $message)
                        @php $isMine = $message->senderID == auth()->id(); @endphp
                        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] {{ $isMine ? 'bg-amber-500 text-slate-900' : 'bg-slate-100 text-slate-800' }} rounded-2xl px-4 py-3">
                                <p class="text-sm">{{ $message->message_content }}</p>
                                <p class="text-xs {{ $isMine ? 'text-amber-800' : 'text-slate-400' }} mt-1">
                                    {{ $message->created_at ? $message->created_at->diffForHumans() : '' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-400">
                            <p>No messages yet. Say hello!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Send Message Form -->
                <div class="border-t border-slate-200 p-4">
                    <form action="{{ route('messages.store') }}" method="POST" class="flex gap-3">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $otherUser->idUser }}">
                        <input type="text" name="message" placeholder="Type a message..." required maxlength="512"
                            class="flex-1 rounded-xl border-slate-300 focus:ring-amber-500 focus:border-amber-500 text-sm">
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-6 py-2.5 rounded-xl transition-all duration-300 text-sm">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('messages-container').scrollTop = document.getElementById('messages-container').scrollHeight;
    </script>
    @endpush
</x-app-layout>
