<!-- dashboard.events.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full h-96 mb-6 relative">
                    <img src="{{ asset('img/images.jpg') }}" alt="Descrierea imaginii" class="object-cover w-full h-full">
                </div>

                <div class="p-6 text-gray-900 text-center">
                    {{ __("You're on the Events page!") }}
                </div>

                <br>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    @foreach($events as $event)
        <div class="bg-white shadow-md rounded-lg p-4">
            <h3 class="font-semibold text-lg">{{ $event->event_name }}</h3>
            <p class="text-gray-700">{{ $event->event_description }}</p>
            <p class="text-gray-500">{{ $event->event_date }}</p>
            <p class="text-gray-500">{{ $event->event_location }}</p>
            
            <div class="mt-4">
                <p><strong>Participants:</strong></p>
                <ul>
                    <li>Visitors: {{ $event->visitors_count }}</li>
                    <li>Exhibitors: {{ $event->exhibitors_count }}</li>
                </ul>
            </div>
        </div>
    @endforeach
</div>





</x-app-layout>
