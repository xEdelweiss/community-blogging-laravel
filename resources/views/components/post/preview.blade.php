@props(['post', 'noAuthor' => false])

<div x-data onclick="window.location='{{ $link }}';"
    class="group relative flex cursor-pointer flex-col gap-3 overflow-hidden bg-white p-6 shadow-sm transition duration-150 ease-in hover:shadow-post dark:bg-gray-800 sm:rounded-lg">
    <a title="{{ $post->title }}" href="{{ $link }}"
        class="absolute inset-0 z-10"></a>
    <div class="flex flex-col gap-1 pe-1">
        <div class="flex flex-nowrap items-start justify-between gap-4">
            <div class="flex flex-col">
                @if ($post->title)
                    <div
                        class="line-clamp-2 text-xl font-semibold group-hover:text-primary dark:text-gray-100">
                        {{ $post->title }}
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <div
                        class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                        @if (!$noAuthor)
                            <div
                                class="z-20 font-bold text-gray-900 hover:text-primary">
                                <a
                                    href="{{ route('user.show', [$post->author]) }}">{{ $post->author->name }}</a>
                            </div>
                            <div>&bull;</div>
                        @endif

                        <div>{{ $post->published_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>

            <x-topic-icon class="z-20" :topic="$post->topic" />
        </div>
    </div>

    @if ($post->cover && !$post->url)
        <div class="flex justify-center">
            <a href="{{ $link }}">
                <img loading="lazy"
                    class="max-h-[400px] rounded-xl object-cover"
                    src="{{ $post->cover }}" />
            </a>
        </div>
    @endif

    <div x-data="embedIntro({{ json_encode(nl2br($post->intro)) }})">
        @if ($post->intro)
            <div x-bind="intro" class="text-gray-900 dark:text-gray-100">{!! nl2br($post->intro) !!}</div>
        @endif

        @if ($post->url)
            <div x-bind="embed" x-embed="{{ $post->url }}" class="w-full mt-4"></div>
        @endif
    </div>

    <div class="mt-1 flex items-center justify-between pe-1">
        <div
            class="z-20 flex items-center gap-4 space-x-2 text-xs font-semibold text-gray-400">
            <x-like-button :post="$post" />
            <x-comment-button :post="$post" />
        </div>

        <div class="z-20 flex items-center gap-4 text-gray-400">
            <x-views-count-indicator :post="$post" />
            <x-bookmark-button :post="$post" />
        </div>
    </div>
</div>
