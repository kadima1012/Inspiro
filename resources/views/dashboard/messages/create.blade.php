<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            Message {{ $recipient->user_first_name }} {{ $recipient->user_last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="recipient_id" value="{{ $recipient->idUser }}">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 mb-2">To</label>
                        <p class="text-slate-900 font-semibold">{{ $recipient->user_first_name }} {{ $recipient->user_last_name }}</p>
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-slate-700 mb-2">Message</label>
                        <textarea name="message" id="message" rows="4" required maxlength="512"
                            class="w-full rounded-xl border-slate-300 focus:ring-amber-500 focus:border-amber-500 text-sm"
                            placeholder="Write your message..."></textarea>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ url()->previous() }}" class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-semibold transition-all duration-300">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-900 rounded-xl text-sm font-semibold transition-all duration-300">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
