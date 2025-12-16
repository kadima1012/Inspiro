<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artwork') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('artwork.update', $artwork->idArt) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="art_Title" class="block font-medium text-sm text-gray-700">{{ __('Title') }}</label>
                            <input id="art_Title" class="block mt-1 w-full" type="text" name="art_Title" value="{{ $artwork->art_Title }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="art_Description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                            <textarea id="art_Description" class="block mt-1 w-full" name="art_Description" required>{{ $artwork->art_Description }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="art_creation_date" class="block font-medium text-sm text-gray-700">{{ __('Creation Date') }}</label>
                            <input id="art_creation_date" class="block mt-1 w-full" type="date" name="art_creation_date" value="{{ $artwork->art_creation_date }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="art_Visible" class="block font-medium text-sm text-gray-700">{{ __('Visible') }}</label>
                            <select id="art_Visible" name="art_Visible" class="block mt-1 w-full" required>
                                <option value="1" {{ $artwork->art_Visible ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                <option value="0" {{ !$artwork->art_Visible ? 'selected' : '' }}>{{ __('No') }}</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="art_quantity" class="block font-medium text-sm text-gray-700">{{ __('Quantity') }}</label>
                            <input id="art_quantity" class="block mt-1 w-full" type="number" name="art_quantity" value="{{ $artwork->art_quantity }}" required min="1" />
                        </div>

                        <div class="mt-4">
                            <label for="filepath" class="block font-medium text-sm text-gray-700">{{ __('Artwork Image') }}</label>
                            <input id="filepath" class="block mt-1 w-full" type="file" name="filepath" />
                            @if ($artwork->filepath)
                                <div class="mt-2">
                                    <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="w-32 h-32 object-cover">
                                </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <label for="idArtworkType" class="block font-medium text-sm text-gray-700">{{ __('Artwork Type') }}</label>
                            <select id="idArtworkType" name="idArtworkType" class="block mt-1 w-full" required>
                                @foreach($artworkTypes as $type)
                                    <option value="{{ $type->idArtworkType }}" {{ $type->idArtworkType == $artwork->idArtworkType ? 'selected' : '' }}>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="inline-block bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Update Artwork') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
