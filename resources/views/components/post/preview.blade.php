@props(['post', 'userLike', 'likeScore', 'noAuthor' => false])

<div x-data x-ref="container" onclick="window.location='{{ $link }}';"
    x-view-track.listing.post.400ms="{{ $post->id }}"
    @if (request()->routeIs('user.bookmarks')) x-on:bookmark-removed="$refs.container.remove()" @endif
    class="main-card group relative flex cursor-pointer flex-col gap-3 overflow-hidden p-6 pb-4 shadow-sm transition duration-150 ease-in hover:shadow-post dark:bg-gray-800">

    <a title="{{ $post->title }}" href="{{ $link }}"
        class="absolute inset-0 z-10"></a>

    <div class="flex flex-col gap-1 pe-1">
        <div class="flex flex-nowrap items-start justify-between gap-4">
            <div class="flex flex-col">
                @if ($post->title)
                    <div
                        class="line-clamp-2 text-xl font-bold group-hover:text-primary dark:text-gray-100">
                        {{ $post->title }}
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <div
                        class="flex items-center space-x-2 text-sm font-medium text-gray-400">
                        @if (!$noAuthor)
                            <div class="z-20 text-gray-900 hover:text-primary">
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

    <div class="space-y-4" x-data="embedIntro({{ json_encode(nl2p($post->intro)) }})">
        @if ($post->intro)
            <div x-bind="intro"
                class="space-y-1 text-gray-900 dark:text-gray-100">
                {!! nl2p($post->intro) !!}</div>
        @endif

        @if ($post->url)
            <div x-bind="embed" x-embed="{{ $post->url }}" class="w-full">
            </div>
        @endif
    </div>

    <div
        class="mt-1 flex items-center justify-between pe-1 text-sm text-gray-400">
        <div class="z-20 flex items-center gap-4 space-x-2">
            <livewire:common.rating :post="$post" :user-like="$userLike"
                :like-score="$likeCount" />
            <x-comment-button :post="$post" />

            {{-- <span
                class="rounded-full bg-gray-100 px-3 pb-1 pt-[0.375rem] text-xs text-gray-700">{{ __('Editorial') }}</span> --}}
        </div>

        <div class="z-20 flex items-center gap-4">
            <span class="pt-[0.125rem] text-right text-xs">
                {{ __(':count min read', ['count' => random_int(2, 20)]) }}</span>
            <x-views-count-indicator :post="$post" />
            <livewire:common.bookmark-button :bookmarkable="$post" />
        </div>
    </div>
</div>
