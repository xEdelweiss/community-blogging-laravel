<x-app-layout>
    <div class="mx-auto flex justify-between pb-22 md:flex-row lg:gap-x-10" style="max-width: 1400px;">
        <x-topics-sidebar />

        <main class="mx-auto w-full md:flex-1 xl:max-w-[835px]">
            {{ $slot }}
        </main>

        {{-- hidden flex-none lg:sticky lg:block lg:self-start --}}
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
