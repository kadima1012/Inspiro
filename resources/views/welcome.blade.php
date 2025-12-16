<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inspiro') }}
        </h2>
    </x-slot>

    <style>
        .carousel-item {
            position: relative;
            display: none;
        }
        .carousel-item.active {
            display: block;
        }
        .carousel-controls {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10; /* Ensure arrows are above carousel items */
        }
    </style>

    <div class="relative max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div id="carousel" class="relative w-full h-96 overflow-hidden rounded-lg">
            <!-- Carousel wrapper -->
            <div class="carousel-item active h-full transition-all">
                <img src="{{ \App\Helpers\StorageHelper::customUrl('artworks/painting1.jpg') }}" class="w-full h-full object-cover" alt="Slide 1">
            </div>
            <div class="carousel-item h-full transition-all">
                <img src="{{ \App\Helpers\StorageHelper::customUrl('artworks/painting2.jpg') }}" class="w-full h-full object-cover" alt="Slide 2">
            </div>
            <div class="carousel-item active h-full transition-all">
                <img src="{{ \App\Helpers\StorageHelper::customUrl('artworks/painting3.jpg') }}" class="w-full h-full object-cover" alt="Slide 1">
            </div>
            <div class="carousel-item h-full transition-all">
                <img src="{{ \App\Helpers\StorageHelper::customUrl('artworks/painting4.jpg') }}" class="w-full h-full object-cover" alt="Slide 2">
            </div>
            <div class="carousel-item h-full transition-all">
                <img src="{{ \App\Helpers\StorageHelper::customUrl('artworks/painting5.jpg') }}" class="w-full h-full object-cover" alt="Slide 3">
            </div>


        </div>
        <!-- Slider controls -->
        <div class="carousel-controls start-0">
            <button type="button" class="p-2 bg-gray-800 text-white rounded-full" id="prevSlide">
                &#10094; <!-- Left Arrow -->
            </button>
        </div>
        <div class="carousel-controls end-0">
            <button type="button" class="p-2 bg-gray-800 text-white rounded-full" id="nextSlide">
                &#10095; <!-- Right Arrow -->
            </button>
        </div>
    </div>
    <div class="flex justify-center">
        <form class="flex justify-between">
            <input class="w-6 h-6" id="slide1" type="radio" name="selectedSlide" value="1" checked></input>
            <label for="slide1" class="w-3 h-3 rounded-full bg-gray-400 cursor-pointer"></label>
            &nbsp;
            <input class="w-6 h-6" id="slide2" type="radio" name="selectedSlide" value="2"></input>
            <label for="slide2" class="w-3 h-3 rounded-full bg-gray-400 cursor-pointer"></label>
            &nbsp;
            <input class="w-6 h-6" id="slide3" type="radio" name="selectedSlide" value="3"></input>
            <label for="slide3" class="w-3 h-3 rounded-full bg-gray-400 cursor-pointer"></label>
            &nbsp;
            <input class="w-6 h-6" id="slide4" type="radio" name="selectedSlide" value="4"></input>
            <label for="slide4" class="w-3 h-3 rounded-full bg-gray-400 cursor-pointer"></label>
            &nbsp;
            <input class="w-6 h-6" id="slide5" type="radio" name="selectedSlide" value="5"></input>
            <label for="slide5" class="w-3 h-3 rounded-full bg-gray-400 cursor-pointer"></label>
        </form>
    </div>
    <div class="flex justify-center items-center mb-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
    </div>
    <div class="container mx-auto px-4 py-8">
        <div class="text-center">
            <h1 class="text-xl font-bold text-gray-800 mb-4">Join the Creative Revolution on Inspiro!</h1>
            <p class="text-xl text-gray-600 mb-6">Discover, Showcase, and Sell Your Art with Ease</p>
        </div>
        <div class="max-w-4xl mx-auto">
            <p class="text-lg text-gray-700 mb-8">Welcome to <strong class="font-semibold">Inspiro</strong>, the ultimate platform for artists to unleash their creativity, connect with a global audience, and transform their passion into profit. Whether you're an emerging talent or a seasoned professional, our app offers everything you need to thrive in the art world.</p>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Why Choose Inspiro?</h2>
            <ul class="list-none space-y-4">
                <li class="p-4 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">1. Showcase Your Talent</h3>
                    <p class="text-gray-700">Your art deserves to be seen. With <strong class="font-semibold">Inspiro</strong>, you can create a stunning portfolio that highlights your unique style. Upload your artwork effortlessly and captivate potential buyers with high-quality images and detailed descriptions.</p>
                </li>
                <li class="p-4 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">2. Reach a Global Audience</h3>
                    <p class="text-gray-700">Break free from local limitations and share your creations with art lovers around the world. Our platform connects you to a diverse community of collectors, enthusiasts, and fellow artists, expanding your reach like never before.</p>
                </li>
                <li class="p-4 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">3. Sell Your Art Securely</h3>
                    <p class="text-gray-700">Turning your creativity into income has never been easier. List your pieces for sale, set your prices, and manage orders directly through our intuitive interface. We handle the transaction logistics, allowing you to focus on what you do best – creating amazing art.</p>
                </li>
                <li class="p-4 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">4. Collaborate and Network</h3>
                    <p class="text-gray-700">Join a vibrant community of artists and art enthusiasts. Engage in collaborations, participate in virtual art events, and exchange ideas to fuel your inspiration. <strong class="font-semibold">Inspiro</strong> is more than a platform; it's a thriving ecosystem where artists grow together.</p>
                </li>
                <li class="p-4 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-bold text-gray-800">5. Enhance Your Brand</h3>
                    <p class="text-gray-700">Build a recognizable brand with our customizable artist profiles. Showcase your biography, achievements, and portfolio in a professional manner. Stand out to potential buyers and galleries looking for new talent.</p>
                </li>
            </ul>
            <h2 class="text-2xl font-semibold text-gray-800 mt-8 mb-4">Get Started in Minutes</h2>
            <ol class="list-decimal list-inside space-y-4">
                <li class="text-gray-700"><strong>Sign Up:</strong> Create your artist profile quickly and easily.</li>
                <li class="text-gray-700"><strong>Upload Your Art:</strong> Use our user-friendly tools to showcase your creations.</li>
                <li class="text-gray-700"><strong>Connect and Sell:</strong> Engage with buyers, network with other artists, and start selling your art.</li>
            </ol>
            <div class="text-center mt-8">
                <a href="{{ route('register') }}" class="inline-block bg-gray-800 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-blue-600 transition duration-300">Join Inspiro Today!</a>
            </div>
            <p class="text-center text-gray-700 mt-4">Ready to take your art to the next level? Join <strong class="font-semibold">Inspiro</strong> today and turn your passion into a thriving career. Together, we can bring your art to the world.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentIndex = 0;
            const items = document.querySelectorAll('.carousel-item');
            const radioInputs = document.querySelectorAll('input[name="selectedSlide"]');
            const totalItems = items.length;

            const updateCarousel = () => {
                radioInputs.forEach(input => input.checked = false);
                radioInputs[currentIndex].checked = true;
                items.forEach((item, index) => item.classList.toggle('active', index === currentIndex));
            };

            const updateIndex = (index) => {
                currentIndex = index;
                updateCarousel();
            };

            const nextSlide = () => updateIndex((currentIndex + 1) % totalItems);
            const prevSlide = () => updateIndex((currentIndex - 1 + totalItems) % totalItems);

            const startInterval = () => setInterval(nextSlide, 5000);
            let intervalId = startInterval();

            const resetInterval = () => {
                clearInterval(intervalId);
                intervalId = startInterval();
            };

            radioInputs.forEach(input => input.addEventListener('change', () => updateIndex(parseInt(input.value) - 1)));
            document.querySelector('#nextSlide').addEventListener('click', () => { nextSlide(); resetInterval(); });
            document.querySelector('#prevSlide').addEventListener('click', () => { prevSlide(); resetInterval(); });
        });
    </script>
</x-app-layout>
