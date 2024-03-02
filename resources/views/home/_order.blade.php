<header class="mb-4 flex justify-between px-3 sm:px-0">
    <div class="flex flex-wrap justify-start gap-x-4">
        @auth()
            <a href="{{ route('home.relevant', ['topic' => $criteria->topic, 'tag' => $criteria->tag]) }}"
                class="@if (request()->routeIs('home.relevant')) bg-white shadow-sm overflow-hidden rounded-lg dark:bg-gray-800 @endif px-3 py-1 hover:text-primary">{{ __('Relevant') }}</a>
        @endauth

        <a href="{{ route('home', ['topic' => $criteria->topic, 'tag' => $criteria->tag]) }}"
            class="@if (request()->routeIs('home')) bg-white shadow-sm overflow-hidden rounded-lg dark:bg-gray-800 @endif px-3 py-1 hover:text-primary">{{ __('Latest') }}</a>

        <a href="{{ route('home.top', ['topic' => $criteria->topic, 'tag' => $criteria->tag]) }}"
            class="@if (request()->routeIs('home.top')) bg-white shadow-sm overflow-hidden rounded-lg dark:bg-gray-800 @endif px-3 py-1 hover:text-primary">{{ __('Top') }}</a>
    </div>

    @if (request()->routeIs('home.top'))
        <div>
            <x-listing.period-select />
        </div>
    @endif

    @if (request()->routeIs('home'))
        <div>
            <x-listing.min-score-select />
        </div>
    @endif
</header>
