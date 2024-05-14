<header
    class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white text-sm py-3 md:py-0 dark:bg-gray-800 shadow-md">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
        <div class="relative md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <a class="flex-none text-xl font-semibold dark:text-white dark:focus:outline-none dark: dark:focus:ring-gray-600"
                    href="/" aria-label="Brand">DCodeMania</a>
                <div class="md:hidden">
                    <button type="button"
                        class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark: dark:focus:ring-gray-600"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4"
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
                    class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
                    <div
                        class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">
                        <a class="{{ request()->is('/') ? 'font-medium text-blue-600 py-3 md:py-6 dark:text-blue-500 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' : 'font-medium text-gray-500 py-3 md:py-6 dark:text-gray-400 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' }}"
                            href="/" aria-current="page">Home</a>

                        <a class="{{ request()->is('categories*') ? 'font-medium text-blue-600 py-3 md:py-6 dark:text-blue-500 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' : 'font-medium text-gray-500 py-3 md:py-6 dark:text-gray-400 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' }}"
                            href="/categories">Categories</a>

                        <a class="{{ request()->is('products*') ? 'font-medium text-blue-600 py-3 md:py-6 dark:text-blue-500 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' : 'font-medium text-gray-500 py-3 md:py-6 dark:text-gray-400 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' }}"
                            href="/products">Products</a>

                        @if (auth()->check())
                            <a class="{{ request()->is('cart*') ? 'font-medium flex items-center text-blue-600 py-3 md:py-6 dark:text-blue-500 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' : 'font-medium flex items-center text-gray-500 py-3 md:py-6 dark:text-gray-400 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' }}"
                                href="/cart">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span class="mr-1">Cart</span>
                                <span
                                    class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">4</span>
                            </a>
                            <div class="pt-3 md:pt-0">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark: dark:focus:ring-gray-600">
                                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @else
                            <a class="{{ request()->is('cart*') ? 'font-medium flex items-center text-blue-600 py-3 md:py-6 dark:text-blue-500 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' : 'font-medium flex items-center text-gray-500 py-3 md:py-6 dark:text-gray-400 dark:focus:outline-none dark: dark:focus:ring-gray-600 hover:text-gray-400 dark:hover:text-gray-500' }}"
                                href="/login">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span class="mr-1">Cart</span>
                            </a>
                            <div class="pt-3 md:pt-0">
                                <a class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark: dark:focus:ring-gray-600"
                                    href="/login">
                                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    Log in
                                </a>
                            </div>
                        @endif

                        {{-- Bagian dropdown user --}}
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
