<header
    class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full text-sm py-3 md:py-0 shadow-md px-4 sm:px-6 lg:px-8 backdrop-filter backdrop-blur-md bgdrop">
    <nav class="max-w-[85rem] w-full px-4 sm:px-6 lg:px-8 py-1 " aria-label="Global">
        <div class="relative md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between w-full lg:w-60 md:w-56">
                <a class="flex-none text-xl font-semibold text-white dark:focus:outline-none dark:ring-gray-600"
                    href="/" aria-label="Brand" id="judul"><img src="{{ asset('assets/img/panjanglogo.png') }}" alt="" class=" h-5"></a>
                <div class="md:hidden">
                    <button type="button"
                        class=" bg-transparent hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-grajy-800disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-gray-600"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="text-white  hs-collapse-open:hidden flex-shrink-0 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4 text-white"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="navbar-collapse-with-animation"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
                <div
                    class="overflow-hidden overflow-y-auto max-h-[75vh] scrollbar-w-2 scrollbar-thumb-rounded-full scrollbar-track-bg-gray-100 scrollbar-thumb-bg-gray-300 dark:scrollbar-track-bg-slate-700 dark:scrollbar-thumb-bg-slate-500">
                    <div
                        class="flex flex-col gap-x-0 mt-5 divide-y divide-none divide-gray-200 divide-opacity-15 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">
                        <a class="{{ request()->is('/') || request()->is('home') ? 'font-medium py-3 md:py-3 text-blue-400 focus:outline-none ring-gray-600  hover:text-gray-200' : 'font-medium py-3 md:py-3 text-gray-300 focus:outline-none ring-gray-600 hover:text-gray-200' }} navlist"
                            href="/" aria-current="page">Home</a>

                        <a class="{{ request()->is('categories*') ? 'ffont-medium py-3 md:py-3 text-blue-400 focus:outline-none ring-gray-600  hover:text-gray-200' : 'font-medium py-3 md:py-3 text-gray-300 focus:outline-none ring-gray-600 hover:text-gray-200' }} navlist"
                            href="/categories">Categories</a>

                        <a class="{{ request()->is('products*') ? 'font-medium py-3 md:py-3 text-blue-400 focus:outline-none ring-gray-600  hover:text-gray-200' : 'font-medium py-3 md:py-3 text-gray-300 focus:outline-none ring-gray-600 hover:text-gray-200' }} navlist"
                            href="/products">Products</a>
                        <a class="{{ request()->is('cart*') ? 'font-medium flex items-center text-blue-400 py-3 md:py-3 dark:text-blue-500 dark:focus:outline-none dark:ring-gray-600 hover:text-gray-200 dark:hover:text-gray-500' : 'font-medium flex items-center text-gray-300 py-3 md:py-3 dark:text-gray-400 dark:focus:outline-none dark:ring-gray-600 hover:text-gray-200 dark:hover:text-gray-500' }} navlist"
                            href="/cart">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="flex-shrink-0 w-5 h-5 mr-1.5" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                </path>
                            </svg>
                            <span class="mr-2">Cart</span>
                            <span
                                class="px-1.5 rounded-full text-xs font-medium bg-slate-300 border border-blue-200 text-blue-600 text-center">{{ is_array($total_count) ? '' : htmlspecialchars($total_count) }}</span>
                        </a>
                        @if (auth()->check())
                        @else
                            <div class="pt-3 md:pt-0">
                                <a class="py-1 px-4 inline-flex items-center gap-x-2 text-sm rounded-full border border-transparent bg-blue-400 text-white hover:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:ring-gray-600"
                                    href="/login">
                                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    Log in
                                </a>
                            </div>
                        @endif

                        {{-- Bagian dropdown user --}}{{-- Bagian dropdown user --}}
                        @auth
                            <div
                                class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--trigger:hover] md:py-3">
                                <button type="button"
                                    class="flex items-center w-full text-gray-300 hover:text-gray-200 font-medium dark:text-gray-400 dark:hover:text-gray-500 mt-2 md:mt-0 lg:mt-0 mb-4 md:mb-0">
                                    {{ auth()->user()->name }}
                                    <svg class="ms-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>

                                <div
                                    class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white md:shadow-md rounded-lg p-2 dark:bg-gray-800 md:dark:border dark:border-gray-700 dark:divide-gray-700 before:absolute top-full md:border before:-top-5 before:start-0 before:w-full before:h-5">
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        href="/profile">
                                        Profile
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        wire:navigate href="/my-orders">
                                        My Orders
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                            Logout
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
