<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Artwork to Market') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div>
                        <label for="art_Title" class="block font-medium text-sm text-gray-700">{{ __('Title') }}</label>
                        <p>{{ $artwork->art_Title }}</p>
                    </div>

                    <div class="mt-4">
                        <label for="art_Description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                        <p>{{ $artwork->art_Description }}</p>
                    </div>

                    <div class="mt-4">
                        <label for="art_creation_date" class="block font-medium text-sm text-gray-700">{{ __('Creation Date') }}</label>
                        <p>{{ $artwork->art_creation_date }}</p>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">{{ __('Artwork Image') }}</label>
                        <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="mt-2 rounded-lg">
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <form action="{{ route('artwork.addToMarket', $artwork->idArt) }}" method="POST">
                            @csrf

                            <p>{{ __('Choose a price for your artwork') }}</p>
                            <input id="item_price" class="block mt-1 w-full" type="number" step="0.01" min="0" max="99999999.99" name="item_price" required />

                            <div class="mt-4">
                                <label for="quantity_for_sale" class="block font-medium text-sm text-gray-700">{{ __('Quantity for Sale') }}</label>
                                <input id="quantity_for_sale" class="block mt-1 w-full" type="number" name="quantity_for_sale" min="1" max="{{ $artwork->art_quantity }}" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Add to Market') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
