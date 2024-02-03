<div x-data="{ sidebarOpen: false }" @left-sidebar-open.window="sidebarOpen = true" :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
    @click="sidebarOpen = false"
    class="sm:inset-none fixed inset-0 z-10 hidden bg-backdrop sm:relative sm:sticky sm:top-[40px] sm:block sm:self-start sm:bg-transparent">
    <div @click.stop class="h-screen w-2/3 bg-white shadow-dialog sm:h-auto sm:w-full sm:bg-transparent sm:shadow-none">

        {{-- navigation-like panel --}}
        <div class="flex h-20 items-center justify-start px-2 sm:hidden">
            <button @click="sidebarOpen = ! sidebarOpen"
                class="dark:text-gray-500 dark:hover:text-gray-400 dark:hover:bg-gray-900 dark:focus:bg-gray-900 dark:focus:text-gray-400 me-1 inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <a href="{{ route('home') }}" wire:navigate>
                <x-application-logo class="dark:text-gray-200 block h-9 w-auto fill-current text-gray-800" />
            </a>
        </div>

        <aside class="w-full space-y-4 px-2 sm:w-[210px] sm:p-0">
            {{ $slot }}
        </aside>
    </div>
</div>
