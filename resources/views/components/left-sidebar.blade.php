<div x-data="{ sidebarOpen: false }" @left-sidebar-open.window="sidebarOpen = true"
    :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
    @click="sidebarOpen = false"
    class="xl:inset-none fixed inset-0 z-30 hidden bg-backdrop xl:sticky xl:top-[40px] xl:block xl:self-start xl:bg-transparent">
    <div @click.stop
        class="h-screen w-2/3 bg-white shadow-dialog sm:w-1/3 sm:ps-6 xl:h-auto xl:w-full xl:bg-transparent xl:ps-0 xl:shadow-none">

        {{-- navigation-like panel --}}
        <div class="flex h-20 items-center justify-start px-2 xl:hidden">
            <button @click="sidebarOpen = ! sidebarOpen"
                class="me-1 inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
                <x-icons.cross class="h-6 w-6" />
            </button>

            <a href="{{ route('home') }}" wire:navigate>
                <x-application-logo
                    class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <aside class="w-full space-y-4 px-2 xl:w-[210px] xl:p-0">
            {{ $slot }}
        </aside>
    </div>
</div>
