<x-app-layout :user_username="$user->user_username">
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center py-20 bg-white rounded-xl shadow-lg">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <h3 class="text-lg font-semibold text-slate-500">Not an Artist</h3>
                <p class="text-slate-400 mt-1">This user is not registered as an artist.</p>
            </div>
        </div>
    </div>
</x-app-layout>
