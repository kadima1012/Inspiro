<nav x-data="{ open: false }" class="bg-slate-900/95 backdrop-blur-sm border-b border-slate-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-auto" />
                        <span class="text-amber-400 font-bold text-xl hidden sm:block">Inspiro</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:ml-8 space-x-1">
                    <a href="{{ route('user.profile', ['username' => $user_username]) }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('user.profile') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Profile</a>
                    <a href="{{ route('user.gallery', ['username' => $user_username]) }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('user.gallery') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Gallery</a>
                    <a href="{{ route('user.shop', ['username' => $user_username]) }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('user.shop') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Shop</a>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex items-center space-x-3">
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

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-slate-900 border-t border-slate-700">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('user.profile', ['username' => $user_username]) }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('user.profile') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Profile</a>
            <a href="{{ route('user.gallery', ['username' => $user_username]) }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('user.gallery') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Gallery</a>
            <a href="{{ route('user.shop', ['username' => $user_username]) }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('user.shop') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Shop</a>
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
                        <button type="submit" class="block w-full text-left text-gray-300 hover:text-white px-3 py-2 text-sm transition-colors duration-300">Log Out</button>
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
