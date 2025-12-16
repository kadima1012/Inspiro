<x-app-layout :user_username="$user->user_username">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->user_username }}'s Gallery
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Artworks
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @forelse($artworks as $artwork)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg gallery-img-container h-60">
                            <div class="p-6 text-gray-900">
                                <p class="font-semibold">{{ $artwork->art_Title }}</p>
                            </div>
                            <a href="{{ route('home.artwork', ['id' => $artwork->idArt]) }}">
                                <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="mt-2 rounded-lg w-full h-full object-cover">
                            </a>
                        </div>
                        @empty
                        <div>
                            This artist doesn't have artwork posted yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
