@if ($tag || $topic)
    <div class="mb-4 ms-3 flex items-center gap-2">
        <a href="{{ route(request()->route()->getName()) }}"
            class="group flex align-baseline text-2xl font-semibold text-gray-800 transition duration-150 ease-in">

            @if ($tag)
                <span class="inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="hidden h-5 w-5 text-primary-dark group-hover:inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </span>

                <span class="inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="inline-block h-5 w-5 text-primary-dark group-hover:hidden">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                    </svg>
                </span>

                <span>{{ str($tag->name)->lower() }}</span>
            @endif

            @if ($topic)
                <span class="inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="mr-3 hidden h-5 w-6 text-primary-dark group-hover:inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </span>

                <span class="inline-block group-hover:hidden">
                    <img class="mr-3 h-6 w-6" src="{{ asset($topic->image) }}"
                        alt="" />
                </span>

                <span>{{ $topic->title }}</span>
            @endif
        </a>
    </div>
@endif
