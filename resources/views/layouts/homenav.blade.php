<nav x-data="{ open: false }" class="bg-red-600 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('welcome') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Searchbar -->
            <div class="hidden border-black border-2 space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                <form id="searchForm" class="relative" action="">
                    <input type="text" class="text-black rounded-md px-3 py-2 text-black ring-1 ring-black" id="searchInput" placeholder="Search artist...">
                    <div id="searchResults" class="absolute w-full left-0 right-0 bg-white border border-gray-300 rounded mt-1 shadow-lg z-10 hidden"></div>
                </form>


                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                    // Hide dropdown when clicking outside
                    $(document).mouseup(function(event) {
                        var $searchInput = $('#searchInput');
                        var $searchResults = $('#searchResults');
                        if (!$searchInput.is(event.target) && !$searchResults.is(event.target) && $searchResults.has(event.target).length === 0) {
                            $searchResults.hide();
                        }
                    });

                    $('#searchInput').on('input', function() {
                        var query = $(this).val().trim();
                        if (query.length >= 2) {
                            /*
                            var link = '/search?query=' + $('#searchInput').val().trim();
                            alert(link);
                            $('#searchForm').attr('action', link );
                            */
                            $.ajax({
                                url: '{{ route("searchList") }}',
                                method: 'GET',
                                data: { query: query },
                                success: function(response) {
                                    if (response && response.length > 0) {
                                        var html = '';
                                        var limitedResults = response.slice(0, 5);
                                        limitedResults.forEach(function(result) {
                                            html += '<a href="user/' + result.user_username + '/profile" class="text-grey-600 ml-2 mr-2">' + result.user_username + '</a><br>';
                                        });
                                        $('#searchResults').html(html);
                                        $('#searchResults').show();
                                    } else {
                                        $('#searchResults').hide();
                                    }
                                }
                            });
                        } else {
                            $('#searchResults').hide();
                        }
                    });
                    // Handle Enter key press
                    $('#searchInput').on('keypress', function(event) {
                        if (event.which === 13) { // Enter key pressed
                            event.preventDefault(); // Prevent the default form submission
                            var query = $(this).val().trim();
                            var searchRouteTemplate = @json(route('search', ['query' => 'PLACEHOLDER']));
                            var link = searchRouteTemplate.replace('PLACEHOLDER', encodeURIComponent(query));
                            window.location.href = link;
                        }
                    });
                </script>
            </div>

            <!-- Nav links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">
                    {{ __('Gallery') }}
                </x-nav-link>
                <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                    {{ __('Shop') }}
                </x-nav-link>
                <x-nav-link :href="route('events')" :active="request()->routeIs('events')">
                    {{ __('Events') }}
                </x-nav-link>
                <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')">
                    {{ __('Blog') }}
                </x-nav-link>
                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                    {{ __('Contact') }}
                </x-nav-link>
            </div>


            <!-- Profile links -->
            <div class="hidden sm:-my-px sm:ml-10 sm:flex flex items-center flex-item-right">
                <!-- Image for Basket -->
                <a href="{{ route('basket') }}" class="ml-4 mr-6 flex-shrink-0 flex items-center">
                    <img src="{{ asset('img/basket.png') }}" class="h-6 w-6" alt="Basket">
                </a>
                &nbsp;
                @if (Route::has('login'))
                    <nav class="">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-white rounded-md px-3 py-2 text-black ring-1 ring-black transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-white rounded-md px-3 py-2 text-black ring-1 ring-black transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                Log in
                            </a>
                            &nbsp;
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-white rounded-md px-3 py-2 text-black ring-1 ring-black transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <form id="searchFormResp" class="" action="">
                &nbsp;
                <input type="text" class="text-black rounded-md px-3 py-2 text-black ring-1 ring-black" id="searchInputResp" placeholder="Search artist...">
            </form>
            <script>
                // Handle Enter key press
                $('#searchInputResp').on('keypress', function(event) {
                        if (event.which === 13) { // Enter key pressed
                            event.preventDefault(); // Prevent the default form submission
                            var query = $(this).val().trim();
                            var searchRouteTemplate = @json(route('search', ['query' => 'PLACEHOLDER']));
                            var link = searchRouteTemplate.replace('PLACEHOLDER', encodeURIComponent(query));
                            window.location.href = link;
                        }
                    });
            </script>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">
                {{ __('Gallery') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                {{ __('Shop') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('events')" :active="request()->routeIs('events')">
                {{ __('Events') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')">
                {{ __('Blog') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Route::has('login'))
                    <nav class="">
                        @auth
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->user_username }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>

                            <x-responsive-nav-link :href="route('basket')">
                                <img src="{{ asset('img/basket.png') }}" class="h-6 w-6" alt="{{ __('Basket') }}">
                            </x-responsive-nav-link>

                            <div class="mt-3 space-y-1">
                                <x-responsive-nav-link :href="route('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-responsive-nav-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                            </div>
                        @else
                            <x-responsive-nav-link :href="route('basket')">
                                <img src="{{ asset('img/basket.png') }}" class="h-6 w-6" alt="{{ __('Basket') }}">
                            </x-responsive-nav-link>
                            <div class="mt-3 space-y-1">
                                <!-- Authentication -->
                                <x-responsive-nav-link :href="route('login')">
                                    {{ __('Login') }}
                                </x-responsive-nav-link>

                                @if (Route::has('register'))
                                    <x-responsive-nav-link :href="route('register')">
                                        {{ __('Register') }}
                                    </x-responsive-nav-link>
                                @endif
                            </div>
                        @endauth
                    </nav>
                @endif
        </div>
    </div>
</nav>
