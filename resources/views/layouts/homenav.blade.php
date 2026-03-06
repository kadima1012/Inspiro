<nav x-data="{
    open: false,
    search: '',
    results: [],
    showResults: false,
    searchRoute: @js(route('searchList')),
    searchPageRoute: @js(route('search', ['query' => 'PLACEHOLDER'])),
    async doSearch() {
        if (this.search.trim().length >= 2) {
            const res = await fetch(this.searchRoute + '?query=' + encodeURIComponent(this.search.trim()));
            this.results = await res.json();
            this.showResults = this.results.length > 0;
        } else {
            this.results = [];
            this.showResults = false;
        }
    },
    goToSearch() {
        if (this.search.trim().length > 0) {
            window.location.href = this.searchPageRoute.replace('PLACEHOLDER', encodeURIComponent(this.search.trim()));
        }
    }
}" @click.outside="showResults = false" class="bg-slate-900/95 backdrop-blur-sm border-b border-slate-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('welcome') }}" class="flex items-center gap-2">
                    <x-application-logo class="block h-8 w-auto" />
                    <span class="text-amber-400 font-bold text-xl hidden sm:block">Inspiro</span>
                </a>
            </div>

            <!-- Search Bar (Desktop) -->
            <div class="hidden sm:flex items-center flex-1 max-w-md mx-8">
                <div class="relative w-full">
                    <input
                        type="text"
                        x-model="search"
                        @input.debounce.300ms="doSearch()"
                        @keydown.enter.prevent="goToSearch()"
                        placeholder="Search artists..."
                        class="w-full bg-slate-800 border border-slate-600 text-gray-200 placeholder-slate-400 rounded-lg px-4 py-2 text-sm focus:ring-amber-500 focus:border-amber-500 transition-all duration-300"
                    >
                    <div x-show="showResults" x-transition class="absolute top-full mt-1 w-full bg-slate-800 border border-slate-600 rounded-lg shadow-xl z-50 overflow-hidden">
                        <template x-for="result in results.slice(0, 5)" :key="result.user_username">
                            <a :href="'user/' + result.user_username + '/profile'" class="block px-4 py-2.5 text-gray-300 hover:bg-slate-700 hover:text-amber-400 transition-colors duration-200 text-sm" x-text="result.user_username"></a>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Nav Links (Desktop) -->
            <div class="hidden sm:flex items-center space-x-1">
                <a href="{{ route('gallery') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('gallery') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Gallery</a>
                <a href="{{ route('shop') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('shop') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Shop</a>
                <a href="{{ route('events') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('events') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Events</a>
                <a href="{{ route('blog') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('blog') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Blog</a>
                <a href="{{ route('contact') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('contact') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Contact</a>
            </div>

            <!-- Right Side (Desktop) -->
            <div class="hidden sm:flex items-center space-x-3 ml-4">
                <a href="{{ route('basket') }}" class="text-gray-300 hover:text-amber-400 transition-colors duration-300 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                </a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-4 py-2 rounded-lg text-sm transition-all duration-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-300">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-4 py-2 rounded-lg text-sm transition-all duration-300">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-slate-800 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-slate-900 border-t border-slate-700">
        <!-- Mobile Search -->
        <div class="px-4 pt-4 pb-2">
            <input
                type="text"
                x-model="search"
                @keydown.enter.prevent="goToSearch()"
                placeholder="Search artists..."
                class="w-full bg-slate-800 border border-slate-600 text-gray-200 placeholder-slate-400 rounded-lg px-4 py-2 text-sm focus:ring-amber-500 focus:border-amber-500"
            >
        </div>

        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('gallery') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('gallery') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Gallery</a>
            <a href="{{ route('shop') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('shop') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Shop</a>
            <a href="{{ route('events') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('events') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Events</a>
            <a href="{{ route('blog') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('blog') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Blog</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('contact') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Contact</a>
        </div>

        <div class="px-4 py-4 border-t border-slate-700">
            <a href="{{ route('basket') }}" class="flex items-center gap-2 text-gray-300 hover:text-amber-400 mb-3 transition-colors duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                Basket
            </a>
            @if (Route::has('login'))
                @auth
                    <div class="mb-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->user_username }}</p>
                        <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="block w-full text-center bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-4 py-2 rounded-lg text-sm mb-2 transition-all duration-300">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-center text-gray-300 hover:text-white px-4 py-2 text-sm transition-colors duration-300">Log Out</button>
                    </form>
                @else
                    <div class="flex gap-2">
                        <a href="{{ route('login') }}" class="flex-1 text-center border border-slate-600 text-gray-300 hover:text-white px-4 py-2 rounded-lg text-sm transition-all duration-300">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold px-4 py-2 rounded-lg text-sm transition-all duration-300">Register</a>
                        @endif
                    </div>
                @endauth
            @endif
        </div>
    </div>
</nav>
