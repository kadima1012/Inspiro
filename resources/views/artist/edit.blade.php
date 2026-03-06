<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Edit Artist Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form method="POST" action="{{ route('artist.update', $artist->idArtist) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="idArtist" value="{{ $artist->idArtist }}">
                    <input type="hidden" name="idUser" value="{{ $artist->idUser }}">

                    <div>
                        <label for="artist_first_name" class="block text-sm font-medium text-slate-700 mb-1">First Name</label>
                        <input type="text" name="artist_first_name" id="artist_first_name" value="{{ $artist->artist_first_name }}" class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                    </div>

                    <div>
                        <label for="artist_last_name" class="block text-sm font-medium text-slate-700 mb-1">Last Name</label>
                        <input type="text" name="artist_last_name" id="artist_last_name" value="{{ $artist->artist_last_name }}" class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                    </div>

                    <div>
                        <label for="artist_description" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                        <textarea name="artist_description" id="artist_description" rows="3" class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">{{ $artist->artist_description }}</textarea>
                    </div>

                    <div>
                        <label for="artist_experience" class="block text-sm font-medium text-slate-700 mb-1">Experience (years)</label>
                        <input type="text" name="artist_experience" id="artist_experience" value="{{ $artist->artist_experience }}" class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                    </div>

                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold py-3 rounded-lg transition-all duration-300">
                        Update Artist Details
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
