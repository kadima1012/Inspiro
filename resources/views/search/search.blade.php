<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <div class="">
                    Result for : {{ request('query') }}
                </div>
            </div>
            <div class="flex flex-col space-y-4">
                @forelse ($results as $result)
                    <div class="p-4 border rounded bg-gray-50 dark:bg-gray-800 flex flex-row sm:flex-row items-center">
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold">{{ $result->user_username }}</h2>
                            <p>{{ $result->email }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="user/{{ $result->user_username }}/profile" class="text-blue-500 hover:underline">View Profile</a>
                        </div>
                    </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No results found for "{{ $query }}".</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $results->links() }} <!-- Generates the pagination links -->
                </div>
            </div>
        </div>
    </x-app-layout>
