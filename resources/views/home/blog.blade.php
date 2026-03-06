<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Featured Article Hero -->
            <div class="relative h-80 sm:h-96 rounded-xl overflow-hidden mb-12 group">
                <img src="{{ asset('img/blog1.jpg') }}" alt="Featured Article" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <span class="inline-block bg-amber-500 text-slate-900 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">Featured</span>
                    <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2">Discover Your Inner Self Through Art</h3>
                    <p class="text-gray-300 max-w-xl">Explore how the creative process reveals hidden truths about who we are and who we can become.</p>
                </div>
            </div>

            <!-- Section Title -->
            <h2 class="text-2xl font-bold text-slate-900 mb-8">Featured Articles</h2>

            <!-- Article Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('img/blog2.jpg') }}" alt="Inspiration from Nature" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Nature</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-2 mb-3 group-hover:text-amber-600 transition-colors duration-300">Inspiration from Nature</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-4">Artists find inspiration in the beauty of nature, from mountain landscapes to delicate wildflowers and flowing rivers.</p>
                        <ul class="text-slate-500 text-xs space-y-1 mb-4">
                            <li class="flex items-center gap-1.5">
                                <span class="w-1 h-1 bg-amber-500 rounded-full"></span>Mountain landscapes
                            </li>
                            <li class="flex items-center gap-1.5">
                                <span class="w-1 h-1 bg-amber-500 rounded-full"></span>Delicate wildflowers
                            </li>
                            <li class="flex items-center gap-1.5">
                                <span class="w-1 h-1 bg-amber-500 rounded-full"></span>Forests and rivers
                            </li>
                        </ul>
                        <p class="text-xs text-slate-400 italic">Discover more about how natural beauty fuels creativity.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('img/blog3.jpg') }}" alt="Modern Painting Techniques" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Techniques</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-2 mb-3 group-hover:text-amber-600 transition-colors duration-300">Modern Painting Techniques</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">We explore various modern painting techniques that are revolutionizing the contemporary art world and pushing boundaries.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('img/blog4.jpeg') }}" alt="Urban Art and Graffiti" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Urban</span>
                        <h3 class="text-lg font-bold text-slate-900 mt-2 mb-3 group-hover:text-amber-600 transition-colors duration-300">Urban Art and Graffiti</h3>
                        <p class="text-slate-600 text-sm leading-relaxed">Urban art and graffiti have become integral parts of modern culture, transforming cityscapes into open-air galleries.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
