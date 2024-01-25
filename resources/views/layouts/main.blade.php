<x-app-layout>
    <div class="mx-auto flex justify-between md:flex-row lg:gap-x-10" style="max-width: 1400px;">
        <aside class="hidden flex-none lg:sticky lg:block lg:self-start" style="width: 210px; top: 40px;">
            <div class="lg:sticky lg:text-center">
                <ul>
                    <li>
                        <a class="group flex items-center rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/10 dark:hover:bg-gray-800 dark:hover:text-blue-700 dark:bg-gray-800" href="#">
                            <img class="w-6 h-6 mr-3" src="{{ asset('img/category/military.png') }}" />

                            <span>Military</span>
                        </a>
                    </li>
                    <li>
                        <a class="group flex items-center rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/10 dark:hover:bg-gray-800 dark:hover:text-blue-700 dark:bg-gray-800" href="#">
                            <img class="w-6 h-6 mr-3" src="{{ asset('img/category/games.png') }}" />

                            <span>Games</span>
                        </a>
                    </li>
                    <li>
                        <a class="group flex items-center rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/10 dark:hover:bg-gray-800 dark:hover:text-blue-700 dark:bg-gray-800" href="#">
                            <img class="w-6 h-6 mr-3" src="{{ asset('img/category/literature.png') }}" />


                            <span>Literature</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="mx-auto w-full md:flex-1 xl:max-w-[835px]">
            {{ $slot }}
        </main>

        {{-- hidden flex-none lg:sticky lg:block lg:self-start --}}
        <div class="hidden sticky self-start w-[266px] 2xl:block" style="top: 40px; width: 266px">
            <div class="max-h-screen space-y-4 overflow-auto pb-15">
                <a class="inherits-color block flex-1" href="/series/css-flexbox-simplified"><div class="panel relative transition-colors duration-300 light  text-black bg-white px-8 py-4 rounded-xl flex flex-col items-center justify-between gap-y-4 text-center" style="height: 225px;"><div class="flex flex-col items-center"><div class="flex w-full flex-col items-center justify-between"><img loading="lazy" class="lazy lazyloaded" src="https://ik.imagekit.io/laracasts/series/thumbnails/css-flexbox-simplified.png" alt="CSS Flexbox Simplified thumbnail" width="85" height="85"></div><div class="mt-3 flex-1"><h5 class="clamp one-line font-poppins text-sm font-semibold tracking-normal dark:text-white xl:text-xs">CSS Flexbox Simplified</h5><p class="line-clamp-2 mt-1 text-[11px] dark:text-grey-100">Flexbox is no longer an advanced topic in CSS. Today, it's an essential tool for styling modern web pages. In this course, we'll use a variety of real-world examples and components to explore all of the CSS properties related to flexbox. These examples will help you to better understand the core concepts and commit them to memory.</p></div></div><div class="w-full w-full max-w-[200px] rounded-xl bg-black/10 px-4 py-1 text-center text-[11px] font-medium leading-loose text-grey-800 dark:bg-blue-700/10 dark:text-grey-600 2xl:text-[9px]"> Laracasts Recommends This Series </div></div></a>
            </div>
        </div>
    </div>
</x-app-layout>
