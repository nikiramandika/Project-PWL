
<nav
    class="px-6 sm:px-6 lg:px-8  w-full navbar navbar-expand-lg position-absolute top-0 z-index-3 {{ Request::is('static-sign-up') ? ' shadow-none  navbar-transparent mt-4' : 'blur bgdrop shadow py-2 start-0 end-0 px-4 sm:px-6 lg:px-8' }}" style="backdrop-filter: saturate(200%) blur(20px) ;">
    <div class="container-fluid px-4 sm:px-6 lg:px-8 {{ Request::is('static-sign-up') ? 'container' : 'container-fluid' }}">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 {{ Request::is('static-sign-up') ? 'text-white' : '' }}"
            href="/">
            <img src="{{ asset('assets/img/gelap.png') }}" alt="" class=" h-5" height="20px">
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav">
                @guest 
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ url('register') }}">
                            <i
                                class="fas fa-user-circle opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-gray-900' }}" style="color: rgb(17 24 39 / var(--tw-text-opacity));"></i>
                            Sign Up
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="{{ url('login') }}">
                            <i
                                class="fas fa-key opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-gray-900' }}" style="color: rgb(17 24 39 / var(--tw-text-opacity));"></i>
                            Log In
                        </a>
                    </li>
                @endguest

                @auth 
                @endauth
            </ul>

            <ul class="navbar-nav">
            </ul>
        </div>
    </div>
</nav> 

{{-- 
@vite('resources/css/app.css')
<header
    class="flex z-50 sticky top-0 flex-wrap md:flex-nowrap w-full text-sm py1 md:py-0 shadow-md px-4 sm:px-6 lg:px-8 backdrop-filter backdrop-blur-md bgdrop">
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
                        class="flex flex-col gap-x-0 mt-0 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">
                        <a class="{{ request()->is('/') || request()->is('home') ? 'font-medium py1 md:py1 text-blue-400 focus:outline-none ring-gray-600  hover:text-gray-200' : 'font-medium py1 md:py1 text-gray-300 focus:outline-none ring-gray-600 hover:text-gray-200' }} navlist"
                            href="/" aria-current="page">Home</a>

                        <a class="{{ request()->is('categories*') ? 'ffont-medium py1 md:py1 text-blue-400 focus:outline-none ring-gray-600  hover:text-gray-200' : 'font-medium py1 md:py1 text-gray-300 focus:outline-none ring-gray-600 hover:text-gray-200' }} navlist"
                            href="/categories">Categories</a>

                        <a class="{{ request()->is('products*') ? 'font-medium py1 md:py1 text-blue-400 focus:outline-none ring-gray-600  hover:text-gray-200' : 'font-medium py1 md:py1 text-gray-300 focus:outline-none ring-gray-600 hover:text-gray-200' }} navlist"
                            href="/products">Products</a>
                        @if (auth()->check())
                        @else
                            <div class="py-1 md:pt-0">
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
                             @auth
                            <div
                                class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--trigger:hover] md:py1">
                                <button type="button"
                                    class="flex items-center w-full text-gray-300 hover:text-gray-200 font-medium dark:text-gray-400 dark:hover:text-gray-500 mt-2 md:mt-0 lg:mt-0">
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
</header> --}}