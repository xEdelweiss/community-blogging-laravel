<header class="mb-4 flex flex-wrap justify-start gap-x-4 px-3 sm:px-0">
    @auth()
        <a href="{{ route('home.relevant', ['topic' => request('topic'), 'tag' => request('tag')]) }}"
            class="@if (request()->routeIs('home.relevant')) bg-white shadow-sm overflow-hidden rounded-lg dark:bg-gray-800 @endif px-3 py-1 hover:text-primary">{{ __('Relevant') }}</a>
    @endauth

    <a href="{{ route('home', ['topic' => request('topic'), 'tag' => request('tag')]) }}"
        class="@if (request()->routeIs('home')) bg-white shadow-sm overflow-hidden rounded-lg dark:bg-gray-800 @endif px-3 py-1 hover:text-primary">{{ __('Latest') }}</a>

    <a href="{{ route('home.top', ['topic' => request('topic'), 'tag' => request('tag')]) }}"
        class="@if (request()->routeIs('home.top')) bg-white shadow-sm overflow-hidden rounded-lg dark:bg-gray-800 @endif px-3 py-1 hover:text-primary">{{ __('Top') }}</a>
</header>
