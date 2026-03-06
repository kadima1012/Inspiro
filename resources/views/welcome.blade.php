<x-app-layout>
    <!-- Hero Section with Carousel -->
    <div x-data="{
        current: 0,
        images: [
            '{{ \App\Helpers\StorageHelper::customUrl('artworks/painting1.jpg') }}',
            '{{ \App\Helpers\StorageHelper::customUrl('artworks/painting2.jpg') }}',
            '{{ \App\Helpers\StorageHelper::customUrl('artworks/painting3.jpg') }}',
            '{{ \App\Helpers\StorageHelper::customUrl('artworks/painting4.jpg') }}',
            '{{ \App\Helpers\StorageHelper::customUrl('artworks/painting5.jpg') }}'
        ],
        autoplay: null,
        init() {
            this.startAutoplay();
        },
        startAutoplay() {
            this.autoplay = setInterval(() => { this.next() }, 5000);
        },
        resetAutoplay() {
            clearInterval(this.autoplay);
            this.startAutoplay();
        },
        next() {
            this.current = (this.current + 1) % this.images.length;
        },
        prev() {
            this.current = (this.current - 1 + this.images.length) % this.images.length;
        }
    }" class="relative w-full h-[70vh] min-h-[500px] overflow-hidden bg-slate-900">
        <!-- Slides -->
        <template x-for="(img, index) in images" :key="index">
            <div x-show="current === index"
                 x-transition:enter="transition-opacity duration-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-700"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0">
                <img :src="img" :alt="'Artwork ' + (index + 1)" class="w-full h-full object-cover" loading="lazy">
            </div>
        </template>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent"></div>

        <!-- Hero Content -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-4 max-w-4xl mx-auto">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Discover & Collect<br><span class="text-amber-400">Extraordinary Art</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                    Where artists showcase their vision and collectors find their next masterpiece. Join a thriving community of creators.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('gallery') }}" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold px-8 py-3.5 rounded-lg text-lg transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/25">
                        Explore Gallery
                    </a>
                    <a href="{{ route('register') }}" class="border-2 border-white/30 hover:border-amber-400 text-white hover:text-amber-400 font-semibold px-8 py-3.5 rounded-lg text-lg transition-all duration-300">
                        Join as Artist
                    </a>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button @click="prev(); resetAutoplay()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-slate-900/60 hover:bg-slate-900/80 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button @click="next(); resetAutoplay()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-slate-900/60 hover:bg-slate-900/80 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- Dot Indicators -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
            <template x-for="(img, index) in images" :key="'dot-' + index">
                <button @click="current = index; resetAutoplay()"
                        :class="current === index ? 'bg-amber-400 w-8' : 'bg-white/40 w-3 hover:bg-white/60'"
                        class="h-3 rounded-full transition-all duration-300"></button>
            </template>
        </div>
    </div>

    <!-- Why Choose Inspiro Section -->
    <div class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Why Choose Inspiro?</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Everything you need to showcase, discover, and sell extraordinary artwork in one platform.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-slate-50 rounded-xl p-8 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-5 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Showcase Your Talent</h3>
                    <p class="text-slate-600 leading-relaxed">Create a stunning portfolio that highlights your unique style. Upload artwork effortlessly with high-quality images and detailed descriptions.</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-8 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-5 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Global Audience</h3>
                    <p class="text-slate-600 leading-relaxed">Connect with art lovers around the world. Our platform bridges creators and collectors across a diverse, international community.</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-8 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-5 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Sell Securely</h3>
                    <p class="text-slate-600 leading-relaxed">List your pieces, set your prices, and manage orders with ease. Focus on creating while we handle the logistics.</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-8 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-5 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Collaborate & Network</h3>
                    <p class="text-slate-600 leading-relaxed">Join a vibrant community. Engage in collaborations, participate in art events, and exchange ideas with fellow creators.</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-8 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-5 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Build Your Brand</h3>
                    <p class="text-slate-600 leading-relaxed">Customizable artist profiles to showcase your biography, achievements, and portfolio. Stand out to galleries and buyers.</p>
                </div>

                <div class="bg-slate-50 rounded-xl p-8 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-5 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Quick Setup</h3>
                    <p class="text-slate-600 leading-relaxed">Sign up, create your profile, upload your art, and start connecting with buyers in just minutes. It is that simple.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Get Started Section -->
    <div class="bg-slate-900 py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Get Started in Minutes</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-amber-500 text-slate-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                    <h3 class="text-lg font-semibold text-white mb-2">Sign Up</h3>
                    <p class="text-slate-400">Create your artist profile quickly and easily.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-amber-500 text-slate-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                    <h3 class="text-lg font-semibold text-white mb-2">Upload Your Art</h3>
                    <p class="text-slate-400">Use our user-friendly tools to showcase your creations.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-amber-500 text-slate-900 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                    <h3 class="text-lg font-semibold text-white mb-2">Connect & Sell</h3>
                    <p class="text-slate-400">Engage with buyers and start selling your art.</p>
                </div>
            </div>
            <a href="{{ route('register') }}" class="inline-block bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold px-10 py-4 rounded-lg text-lg transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/25">
                Join Inspiro Today
            </a>
            <p class="text-slate-400 mt-6">Ready to take your art to the next level? Turn your passion into a thriving career.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <x-application-logo class="h-8 w-auto" />
                        <span class="text-amber-400 font-bold text-xl">Inspiro</span>
                    </div>
                    <p class="text-slate-400 text-sm">The ultimate platform for artists to showcase, connect, and sell their art to the world.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <div class="space-y-2">
                        <a href="{{ route('gallery') }}" class="block text-slate-400 hover:text-amber-400 text-sm transition-colors duration-300">Gallery</a>
                        <a href="{{ route('shop') }}" class="block text-slate-400 hover:text-amber-400 text-sm transition-colors duration-300">Shop</a>
                        <a href="{{ route('events') }}" class="block text-slate-400 hover:text-amber-400 text-sm transition-colors duration-300">Events</a>
                        <a href="{{ route('blog') }}" class="block text-slate-400 hover:text-amber-400 text-sm transition-colors duration-300">Blog</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Get in Touch</h4>
                    <div class="space-y-2">
                        <a href="{{ route('contact') }}" class="block text-slate-400 hover:text-amber-400 text-sm transition-colors duration-300">Contact Us</a>
                        <p class="text-slate-400 text-sm">Based in Liege, Belgium</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-8 pt-8 text-center">
                <p class="text-slate-500 text-sm">Inspiro. All rights reserved.</p>
            </div>
        </div>
    </footer>
</x-app-layout>
