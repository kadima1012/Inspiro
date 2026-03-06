<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <p class="text-slate-600">Results for: <span class="font-semibold text-slate-900">{{ request('query') }}</span></p>
            </div>

            <div class="space-y-3">
                @forelse ($results as $result)
                    <div class="bg-white rounded-xl shadow-lg p-5 flex items-center justify-between hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center font-bold text-lg">
                                {{ strtoupper(substr($result->user_username, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">{{ $result->user_username }}</h3>
                                <p class="text-sm text-slate-500">{{ $result->email }}</p>
                            </div>
                        </div>
                        <a href="user/{{ $result->user_username }}/profile" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-medium px-4 py-2 rounded-lg text-sm transition-all duration-300">
                            View Profile
                        </a>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-xl shadow-lg">
                        <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <h3 class="text-lg font-semibold text-slate-500">No results found</h3>
                        <p class="text-slate-400 mt-1">No results found for "{{ $query }}".</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $results->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
