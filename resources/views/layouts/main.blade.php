<x-app-layout x-data="{ sidebarOpen: false }" @left-sidebar-open.window="sidebarOpen = true">
    <div class="mx-auto flex justify-between pb-22 md:flex-row lg:gap-x-10" style="max-width: 1400px;">

        <div :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }" @click="sidebarOpen = false"
            class="sm:inset-none bg-backdrop fixed inset-0 z-10 hidden sm:relative sm:block sm:bg-transparent">
            <div @click.stop=""
                class="h-screen w-2/3 bg-white shadow-dialog sm:h-auto sm:w-full sm:bg-transparent sm:shadow-none">

                {{-- navigation-like panel --}}
                <div class="flex h-20 items-center justify-start px-2 sm:hidden">
                    <button @click="sidebarOpen = ! sidebarOpen"
                        class="dark:text-gray-500 dark:hover:text-gray-400 dark:hover:bg-gray-900 dark:focus:bg-gray-900 dark:focus:text-gray-400 me-1 inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <a href="{{ route('posts') }}" wire:navigate>
                        <x-application-logo class="dark:text-gray-200 block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <aside class="w-full flex-none px-2 sm:w-[210px] sm:p-0 lg:sticky lg:block lg:self-start"
                    style="top: 40px;">
                    <x-topics-sidebar />
                </aside>
            </div>
        </div>

        <main class="mx-auto w-full md:flex-1 xl:max-w-[835px]">
            {{ $slot }}
        </main>

        <div class="sticky hidden w-[266px] self-start 2xl:block" style="top: 40px; width: 266px">
            <div class="pb-15 max-h-screen space-y-4 overflow-auto">
                <a class="inherits-color block flex-1" href="/series/css-flexbox-simplified">
                    <div class="panel light relative flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-8 py-4 text-center text-black transition-colors duration-300"
                        style="height: 225px;">
                        <div class="flex flex-col items-center">
                            <div class="flex w-full flex-col items-center justify-between"><img loading="lazy"
                                    class="lazy lazyloaded"
                                    src="https://ik.imagekit.io/laracasts/series/thumbnails/css-flexbox-simplified.png"
                                    alt="CSS Flexbox Simplified thumbnail" width="85" height="85"></div>
                            <div class="mt-3 flex-1">
                                <h5
                                    class="clamp one-line font-poppins dark:text-white text-sm font-semibold tracking-normal xl:text-xs">
                                    CSS Flexbox Simplified</h5>
                                <p class="dark:text-grey-100 mt-1 line-clamp-2 text-[11px]">Flexbox is no longer an
                                    advanced topic in CSS. Today, it's an essential tool for styling modern web pages.
                                    In this course, we'll use a variety of real-world examples and components to explore
                                    all of the CSS properties related to flexbox. These examples will help you to better
                                    understand the core concepts and commit them to memory.</p>
                            </div>
                        </div>
                        <div
                            class="text-grey-800 dark:bg-blue-700/10 dark:text-grey-600 w-full w-full max-w-[200px] rounded-xl bg-black/10 px-4 py-1 text-center text-[11px] font-medium leading-loose 2xl:text-[9px]">
                            Laracasts Recommends This Series </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
