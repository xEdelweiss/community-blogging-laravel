<nav class="dark:bg-gray-900 dark:border-gray-700 w-full border-b border-gray-100 bg-gray-100 px-2 pe-4 sm:px-8">

    <div class="mx-auto" style="max-width: 1400px;">
        <div class="flex h-20 items-center justify-between">
            <div class="flex items-center">
                <!-- Hamburger -->
                <div class="flex items-center sm:hidden">
                    <button wire:click="$dispatch('left-sidebar-open')"
                        class="dark:text-gray-500 dark:hover:text-gray-400 dark:hover:bg-gray-900 dark:focus:bg-gray-900 dark:focus:text-gray-400 me-1 inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <a href="{{ route('posts') }}" wire:navigate>
                    <x-application-logo class="dark:text-gray-200 block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <x-search-box class="me-2 ms-3 flex hidden w-full items-center sm:flex sm:w-1/3" />

            <div class="flex shrink-0 items-center gap-3 sm:ms-6">
                <a href="{{ route('post.create') }}">
                    <x-secondary-button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="mr-2 h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>

                        {{ __('Write post') }}
                    </x-secondary-button>
                </a>
                <x-user-avatar-menu />
            </div>
        </div>
    </div>
</nav>
