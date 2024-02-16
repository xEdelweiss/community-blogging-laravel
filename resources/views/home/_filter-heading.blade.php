@if ($tag || $topic)
    <div class="mb-4 ms-3 flex items-center gap-2">
        <a href="{{ route(request()->route()->getName()) }}"
            class="group flex align-baseline text-2xl font-semibold text-gray-800 transition duration-150 ease-in">

            @if ($tag)
                <span class="inline-block">
                    <x-icons.cross
                        class="hidden h-5 w-5 text-primary-dark group-hover:inline-block" />
                </span>

                <span class="inline-block">
                    <x-icons.hash
                        class="inline-block h-5 w-5 text-primary-dark group-hover:hidden" />
                </span>

                <span>{{ str($tag->name)->lower() }}</span>
            @endif

            @if ($topic)
                <span class="inline-block">
                    <x-icons.cross
                        class="mr-3 hidden h-5 w-6 text-primary-dark group-hover:inline-block" />
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
