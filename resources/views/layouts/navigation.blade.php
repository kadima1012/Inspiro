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
                    <a href="{{ route('welcome') }}" class="px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-amber-400 hover:bg-slate-800 transition-all duration-300">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>Home
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('dashboard') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('profile.edit') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Profile</a>

                    @if (!Auth::user()->hasRole('user'))
                        <a href="{{ route('portfolio') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('portfolio') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Portfolio</a>
                        <a href="{{ route('sale') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('sale') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">My Sales</a>
                    @endif

                    @if (Auth::user()->hasRole('admin'))
                        <a href="{{ route('adminPanel') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('adminPanel') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Admin</a>
                    @endif

                    <a href="{{ route('orders') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('orders') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Orders</a>
                    <a href="{{ route('messages.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('messages.*') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }}">Messages</a>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-3">
                <a href="{{ route('basket') }}" class="text-gray-300 hover:text-amber-400 transition-colors duration-300 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 text-sm font-medium text-gray-300 hover:text-white bg-slate-800 rounded-lg px-3 py-2 border border-slate-600 hover:border-slate-500 transition-all duration-300">
                            <span>{{ Auth::user()->user_username }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
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
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('dashboard') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('profile.edit') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Profile</a>

            @if (!Auth::user()->hasRole('user'))
                <a href="{{ route('portfolio') }}" class="block px-3 py-2 rounded-lg text-base font-medium {{ request()->routeIs('portfolio') ? 'text-amber-400 bg-slate-800' : 'text-gray-300 hover:text-amber-400 hover:bg-slate-800' }} transition-all duration-300">Portfolio</a>
                <a href="{{ route('sale') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-300 hover:text-amber-400 hover:bg-slate-800 transition-all duration-300">My Sales</a>
            @endif

            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('adminPanel') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-300 hover:text-amber-400 hover:bg-slate-800 transition-all duration-300">Admin</a>
            @endif

            <a href="{{ route('orders') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-300 hover:text-amber-400 hover:bg-slate-800 transition-all duration-300">Orders</a>
            <a href="{{ route('messages.index') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-300 hover:text-amber-400 hover:bg-slate-800 transition-all duration-300">Messages</a>
        </div>

        <div class="px-4 py-4 border-t border-slate-700">
            <div class="mb-3">
                <p class="text-sm font-medium text-white">{{ Auth::user()->user_username }}</p>
                <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
            </div>
            <a href="{{ route('basket') }}" class="flex items-center gap-2 text-gray-300 hover:text-amber-400 mb-3 transition-colors duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                Basket
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left text-gray-300 hover:text-white px-3 py-2 text-sm transition-colors duration-300">Log Out</button>
            </form>
        </div>
    </div>
</nav>
