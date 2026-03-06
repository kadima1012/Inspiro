<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-400 hover:text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Image / Info Side -->
                    <div class="relative">
                        <img src="{{ asset('img/contact.jpg') }}" alt="Contact" class="w-full h-full object-cover min-h-[300px]">
                        <div class="absolute inset-0 bg-slate-900/60 flex flex-col justify-end p-8">
                            <h3 class="text-2xl font-bold text-white mb-4">Get in Touch</h3>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-gray-300">
                                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <span>address@mail.com</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-300">
                                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>Liege, Belgium</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Side -->
                    <div class="p-8 lg:p-12">
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Send us a message</h3>
                        <p class="text-slate-500 mb-8">We would love to hear from you. Fill out the form and we will get back to you shortly.</p>

                        <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                                <input type="text" name="name" id="name" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-slate-700 mb-1">Subject</label>
                                <input type="text" name="subject" id="subject" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-slate-700 mb-1">Message</label>
                                <textarea name="message" id="message" rows="4" required class="w-full rounded-lg border-slate-300 focus:border-amber-500 focus:ring-amber-500 transition-all duration-300"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold py-3 rounded-lg transition-all duration-300 text-sm">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
