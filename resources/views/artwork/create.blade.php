<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Add Artwork') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form action="{{ route('artwork.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="art_Title" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Title') }}</label>
                        <input id="art_Title" type="text" name="art_Title" required autofocus class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                    </div>

                    <div>
                        <label for="art_Description" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Description') }}</label>
                        <textarea id="art_Description" name="art_Description" rows="4" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300"></textarea>
                    </div>

                    <div>
                        <label for="art_creation_date" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Creation Date') }}</label>
                        <input id="art_creation_date" type="date" name="art_creation_date" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                    </div>

                    <div>
                        <label for="art_Visible" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Visible') }}</label>
                        <select id="art_Visible" name="art_Visible" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                            <option value="1">{{ __('Yes') }}</option>
                            <option value="0">{{ __('No') }}</option>
                        </select>
                    </div>

                    <div>
                        <label for="filepath" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Artwork Image') }}</label>
                        <input id="filepath" type="file" accept=".jpg,.jpeg,.png,.gif,.svg,.webp,.avif,.bmp,.apng,.ico,.tiff,.tif" name="filepath" required class="w-full rounded-lg border-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 transition-all duration-300">
                    </div>

                    <div>
                        <label for="art_quantity" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Quantity') }}</label>
                        <input id="art_quantity" type="number" name="art_quantity" required min="1" class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                    </div>

                    <div>
                        <label for="idArtworkType" class="block text-sm font-medium text-slate-700 mb-1">{{ __('Artwork Type') }}</label>
                        <select id="idArtworkType" name="idArtworkType" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                            @foreach($artworkTypes as $type)
                                <option value="{{ $type->idArtworkType }}">{{ $type->type_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="idArtist" value="{{ $artist->idArtist }}">

                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold py-3 rounded-lg transition-all duration-300">
                        {{ __('Add Artwork') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
