{{-- artists.blade.php --}}

<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ __('Artists') }}

        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">

                <form action="{{ route('artists.index') }}" method="GET">

                    <input type="text" name="search" placeholder="Find artists..." value="{{ Request::input('search') }}" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                    <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset">Search</button>

                </form>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($artists as $artist)

                <div class="p-4 bg-gradient-to-b from-green-400 to-blue-500 shadow rounded-full text-center">

                    <div class="max-w-xl">

                        <h2 class="text-lg font-semibold text-black">{{ $artist->artist_first_name }} {{ $artist->artist_last_name }}</h2>

                        <p class="text-sm text-black">{{ $artist->artist_description }}</p>

                        <p class="mt-2 text-sm text-black">{{ $artist->artist_experience }}</p>

                        <a href="{{ $artist->artist_portfolio }}" class="mt-4 text-sm font-medium text-red-600 hover:text-blue-500">View Portfolio</a>

                    </div>

                </div>

                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
