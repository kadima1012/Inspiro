<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- Logo Section -->
        <div class="flex justify-center items-center mb-6">
            <x-application-logo class="w-16 h-16 fill-current text-gray-500" />
        </div>
        <!-- Welcome Message Section -->
        <div class="text-center">
            <h2 class="text-3xl font-semibold mb-2 text-indigo-600">Welcome Back to Inspiro</h2>
            <p class="text-base leading-relaxed text-gray-600 mb-4">
                Your creative journey continues! Explore new opportunities, connect with fellow artists, and let your art inspire the world. Dive into your dashboard to see what’s new and take your next step with Inspiro.
            </p>
            <a href="{{ route('profile.edit') }}" class="bg-gray-800 text-white font-bold py-2 px-4 rounded-full shadow-md duration-200">
                Edit Profile
            </a>
        </div>
    </div>

    <div class="max-w-screen-lg mx-auto py-6">
        <div class="relative">
            <div class="overflow-hidden rounded-lg">
                <div class="flex transition-transform duration-300 ease-in-out">
                    <div class="w-full">
                        <img src="{{ asset('img/InTheseUncertianTimes_Exhibit-31.jpg') }}" class="w-full">
                    </div>
                    <div class="w-full">
                        <img src="{{ asset('img/images (1).jpg') }}" alt="2" class="w-full" alt="Image 2" class="w-full">
                    </div>
                    <div class="w-full">
                        <img src="{{ asset('img/InTheseUncertianTimes_Exhibit-31.jpg') }}" alt="Image 3" class="w-full">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = document.querySelectorAll('.overflow-hidden > div');

            let index = 0;

            setInterval(() => {
                images[index].style.transform = 'translateX(-100%)';
                index = (index + 1) % images.length;
                images[index].style.transform = 'translateX(0)';
            }, 3000);
        });
    </script>
@endpush
