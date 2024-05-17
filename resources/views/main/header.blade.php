<header x-data='{ openSidebar: false }' class="absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">MyBlog</span>
                <h1 class="text-2xl font-bold">MyBlog</h1>
            </a>
        </div>
        <div class="flex lg:hidden">
            <button @click='openSidebar = true' type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Home</a>
            <button id="dropdownButton" data-dropdown-toggle="dropdown"
                class="text-sm font-semibold leading-6 text-gray-900" type="button">
                <span class="sr-only">Open dropdown</span>
                Blog
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2" aria-labelledby="dropdownButton">
                    <li>
                        <a href="/blog"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">All
                            Blog</a>
                    </li>
                    <li>
                        <a href="/myblog"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">My
                            Blog</a>
                    </li>
                    <li>
                        <a href="/blog/create"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Create
                            Blog
                            <svg class="inline ml-1 w-4 h-4" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#1C274C"
                                        stroke-width="1.5" stroke-linecap="round"></path>
                                    <path
                                        d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7"
                                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                </g>
                            </svg></a>
                    </li>
                </ul>
            </div>
            @auth
                <a href="/profile" class="text-sm font-semibold leading-6 text-gray-900">Profile</a>
            @endauth
            <a href="/about" class="text-sm font-semibold leading-6 text-gray-900">About</a>
            <a href="/contact" class="text-sm font-semibold leading-6 text-gray-900">Contact</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            @auth
                <a href="/logout" class="text-sm font-semibold leading-6 text-gray-900">Log out <span
                        aria-hidden="true">&rarr;</span></a>
            @else
                <a href="/login" class="text-sm font-semibold leading-6 text-gray-900">Log in <span
                        aria-hidden="true">&rarr;</span></a>
            @endauth
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div x-show='openSidebar' x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="lg:hidden" role="dialog"
        aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-50"></div>
        <div
            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">MyBlog</span>
                    <h1 class="text-2xl font-bold">MyBlog</h1>
                </a>
                <button @click='openSidebar = false' type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="/"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Home</a>
                        <a href="/blog"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Blog</a>
                        @auth
                            <a href="/myblog"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">My Blog</a>
                            <a href="/blog/create"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Create Blog</a>
                            <a href="/profile"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Profile</a>
                        @endauth
                        <a href="/about"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">About</a>
                        <a href="/contact"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Contact</a>
                    </div>
                    <div class="py-6">
                        @auth
                            <a href="/logout"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                                out</a>
                        @else
                            <a href="/login"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                                in</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
