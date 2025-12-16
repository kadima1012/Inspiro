<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cancel Artist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($hasPendingOrders)
                <div class="mb-4">
                    <h4>You cannot cancel your artist profile.</h4>
                    <p>You have pending orders that have not been received yet. Please resolve these orders before canceling your artist profile.</p>
                    <p>If you don't want any new order, remove your artworks from the market.</p>
                    <ul class="my-px">
                        @foreach ($orders as $order)
                            <li class="p-4 border rounded bg-gray-50 dark:bg-gray-800 flex flex-col sm:flex-col items-center">
                                <div>
                                    Order ID: {{ $order->idOrder }}
                                </div>
                                <div>
                                    Order status: {{$order->order_status}}
                                </div>
                                <ul>
                                    @foreach ($order->artworks as $artwork)
                                        <li>{{ $artwork->art_Title }} (Quantity: {{ $artwork->quantity_to_order }})</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <a href="{{route('profile.edit')}}" class="my-px px-4 py-2 bg-gray-800 text-white rounded">
                    &#10094; {{__('Profile')}}
                </a>
            @else
                <div class="alert alert-warning">
                    <p>Warning!</p>
                    <p>By canceling your artist profile, all associated data including artworks and orders will be permanently deleted. Are you sure you want to proceed?</p>
                    <form method="POST" action="{{ route('profile.confirm-cancel-artist') }}">
                        @csrf
                        <a href="{{ route('profile.edit') }}" class="my-px px-4 py-2 bg-gray-800 text-white rounded">No, keep my profile</a>
                        <button type="submit" class="my-px px-4 py-2 bg-red-600 text-white rounded">Yes, cancel my artist profile</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
