<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 relative">
        <!-- Background container -->
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-gray-800 z-0"></div>

        <div class="container mx-auto px-4 py-8 relative z-10 ">
            
            <h2 class="text-2xl font-semibold text-gray-200 mb-4 text-center">Discover your inner self</h2>

            <!-- Main Image -->
            <div class="mb-8 h-96 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('img/blog1.jpg') }}" alt="Main Image" class="w-full h-full object-cover">
            </div>
            <br>
            
            <h2 class="text-2xl font-semibold text-gray-200 mb-4 text-center">Featured Articles</h2>

            <!-- Three vertical rectangles -->
            <div class="flex justify-center space-x-4 mb-8">
                <!-- Rectangle 1 -->
                <div class="flex flex-col items-center w-80 bg-gray-100 rounded-lg p-6 shadow-xl transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('img/blog2.jpg') }}" alt="Icon 1" class="rounded-full mb-4 w-24 h-24 border-4 border-gray-600">
                    <h3 class="text-indigo-500 text-lg font-semibold mb-2">Inspiration from Nature</h3>
                    <p class="text-gray-300 text-sm text-center mb-4">Artists find inspiration in the beauty of nature, from mountain landscapes to delicate wildflowers.</p>
                    <ul class="text-gray-300 text-xs list-disc list-inside mb-4">
                        <li>Mountain landscapes</li>
                        <li>Delicate wildflowers</li>
                        <li>Forests and rivers</li>
                    </ul>
                    <p class="text-gray-300 text-xs text-center">Discover more about how <span class="italic font-bold">natural beauty</span> fuels creativity.</p>
                </div>

                <!-- Rectangle 2 -->
                <div class="flex flex-col items-center w-80 bg-gray-100 rounded-lg p-6 shadow-xl transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('img/blog3.jpg') }}" alt="Icon 2" class="rounded-full mb-4 w-24 h-24 border-4 border-gray-600">
                    <h3 class="text-indigo-500 text-lg font-semibold mb-2">Modern Painting Techniques</h3>
                    <p class="text-gray-300 text-sm text-center mb-4">We explore various modern painting techniques that are revolutionizing the contemporary art world.</p>
                </div>

                <!-- Rectangle 3 -->
                <div class="flex flex-col items-center w-80 bg-gray-100 rounded-lg p-6 shadow-xl transform hover:scale-105 transition duration-300">
                    <img src="{{ asset('img/blog4.jpeg') }}" alt="Icon 3" class="rounded-full mb-4 w-24 h-24 border-4 border-gray-600">
                    <h3 class="text-indigo-500 text-lg font-semibold mb-2">Urban Art and Graffiti</h3>
                    <p class="text-gray-300 text-sm text-center mb-4">Urban art and graffiti have become integral parts of modern culture.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
