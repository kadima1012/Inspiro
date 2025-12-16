<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Artwork') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('artwork.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="art_Title" class="block font-medium text-sm text-gray-700">{{ __('Title') }}</label>
                            <input id="art_Title" class="block mt-1 w-full" type="text" name="art_Title" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="art_Description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                            <textarea id="art_Description" class="block mt-1 w-full" name="art_Description" required></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="art_creation_date" class="block font-medium text-sm text-gray-700">{{ __('Creation Date') }}</label>
                            <input id="art_creation_date" class="block mt-1 w-full" type="date" name="art_creation_date" required />
                        </div>

                        <div class="mt-4">
                            <label for="art_Visible" class="block font-medium text-sm text-gray-700">{{ __('Visible') }}</label>
                            <select id="art_Visible" name="art_Visible" class="block mt-1 w-full" required>
                                <option value="1">{{ __('Yes') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="filepath" class="block font-medium text-sm text-gray-700">{{ __('Artwork Image') }}</label>
                            <input id="filepath" class="block mt-1 w-full" type="file" accept=".jpg,.jpeg,.png,.gif,.svg,.webp,.avif,.bmp,.apng,.ico,.tiff,.tif" name="filepath" required />
                        </div>

                        <div class="mt-4">
                            <label for="art_quantity" class="block font-medium text-sm text-gray-700">{{ __('Quantity') }}</label>
                            <input id="art_quantity" class="block mt-1 w-full" type="number" name="art_quantity" required min="1" />
                        </div>

                        <div class="mt-4">
                            <label for="idArtworkType" class="block font-medium text-sm text-gray-700">{{ __('Artwork Type') }}</label>
                            <select id="idArtworkType" name="idArtworkType" class="block mt-1 w-full" required>
                                @foreach($artworkTypes as $type)
                                    <option value="{{ $type->idArtworkType }}">{{ $type->type_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <input id="idArtist" class="block mt-1 w-full" type="hidden" name="idArtist" value="{{ $artist->idArtist }}" />
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="inline-block bg-red-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add Artwork') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
