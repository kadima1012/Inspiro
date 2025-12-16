<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($orders->isEmpty())
                        <p>{{ __("You don't have any orders at the moment.") }}</p>
                    @else
                        @foreach ($orders as $order)
                            <div class="mb-4 border border-gray-200 p-2 rounded-lg ">
                                <p><strong>Order ID:</strong> {{ $order->idOrder }}</p>
                                <p><strong>Status:</strong> {{ $order->order_status }}</p>
                                <p><strong>Details:</strong> {{ $order->order_details }}</p>
                                <p><strong>Basket total:</strong> {{ $order->total() }} €</p>
                                <div class="grid grid-cols-5 gap-4 mt-4">
                                    @foreach ($order->artworks as $artwork)
                                        <div class="border border-gray-200 p-4 rounded-lg artwork-container">
                                            <p><strong>Title:</strong> {{ $artwork->art_Title }}</p>
                                            <p><strong>Description:</strong> {{ $artwork->art_Description }}</p>
                                            <p><strong>Price:</strong> {{ $artwork->shopItem()->item_price }} €</p>
                                            <p><strong>Quantity to Order:</strong> {{ $artwork->quantity_to_order }}</p>
                                            <p><strong>Total price:</strong> {{ $artwork->shopItem()->item_price*$artwork->quantity_to_order }} €</p>
                                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg gallery-img-container">
                                                <a href="{{ route('home.artwork', ['id' => $artwork->idArt]) }}">
                                                    <img src="{{ \App\Helpers\StorageHelper::customUrl($artwork->filepath) }}" alt="{{ $artwork->art_Title }}" class="gallery-img">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($order->order_status=='Sent')
                                    <form action="{{ route('received') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="idOrder" id="idOrder" value="{{$order->idOrder}}">
                                        <button type="submit" class="bg-red-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Order received
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>

.artwork-container {
        width: 50%;

    }

    .gallery-img-container {
        position: relative;
        width: 80%;
        height: 0;
        padding-bottom: 50%;
        overflow: hidden;

    }

    .gallery-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 80%;
        height: 80%;
        object-fit: cover;

    }
</style>

