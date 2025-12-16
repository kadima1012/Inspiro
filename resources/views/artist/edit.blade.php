<!-- resources/views/artist/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artist Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('artist.update', $artist->idArtist) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="idArtist">idArtist:</label>
                            <input type="text" name="idArtist" value="{{ $artist->idArtist }}">
                        </div>
                        <div>
                            <label for="idUser">idUser:</label>
                            <input type="text" name="idUser" value="{{ $artist->idUser }}">
                        </div>
                        <div>
                            <label for="artist_first_name">First Name:</label>
                            <input type="text" name="artist_first_name" value="{{ $artist->artist_first_name }}">
                        </div>
                        <div>
                            <label for="artist_last_name">Last Name:</label>
                            <input type="text" name="artist_last_name" value="{{ $artist->artist_last_name }}">
                        </div>
                        <div>
                            <label for="artist_description">Description:</label>
                            <input type="text" name="artist_description" value="{{ $artist->artist_description }}">
                        </div>
                        <div>
                            <label for="artist_experience">Experience:</label>
                            <input type="text" name="artist_experience" value="{{ $artist->artist_experience }}">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
