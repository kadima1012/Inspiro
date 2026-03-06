<x-app-layout :user_username="$user->user_username">
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-slate-800 to-slate-900 p-8">
                    <div class="flex items-center gap-5">
                        <div class="w-20 h-20 bg-amber-500 rounded-full flex items-center justify-center text-slate-900 font-bold text-3xl">
                            {{ strtoupper(substr($user->user_username, 0, 1)) }}
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">{{ $user->user_username }}</h1>
                            <p class="text-slate-400 mt-1">{{ $user->email }}</p>
                            @auth
                                @if(auth()->id() !== $user->idUser)
                                    <a href="{{ route('messages.create', $user->idUser) }}" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-all duration-300 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        Send Message
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="p-8">
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Profile Information</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-50 rounded-lg">
                            <p class="text-xs text-slate-500 uppercase tracking-wider">Username</p>
                            <p class="text-slate-900 font-medium mt-1">{{ $user->user_username }}</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-lg">
                            <p class="text-xs text-slate-500 uppercase tracking-wider">Email</p>
                            <p class="text-slate-900 font-medium mt-1">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
