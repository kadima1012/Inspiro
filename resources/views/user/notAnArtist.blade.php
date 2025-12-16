<x-app-layout :user_username="$user->user_username">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->user_username }}'s profile
        </h2>
    </x-slot>

    <div class="py-12">
        This user is not an artist
    </div>
</x-app-layout>
