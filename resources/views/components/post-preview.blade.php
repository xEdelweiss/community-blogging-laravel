<div onclick="window.location='{{ $link }}';"
    class="dark:bg-gray-800 flex cursor-pointer flex-col gap-3 overflow-hidden bg-white p-6 shadow-sm transition duration-150 ease-in hover:shadow-post sm:rounded-lg">
    <div class="flex flex-col gap-1 pe-1">
        <div class="flex flex-nowrap items-start justify-between">
            <div class="flex flex-col">
                @if ($post->title)
                    <div class="text-xl font-semibold">
                        {{ $post->title }}
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                        <div class="font-bold text-gray-900 hover:text-primary">
                            <a href="{{ route('user', [$post->author]) }}">{{ $post->author->name }}</a>
                        </div>
                        <div>&bull;</div>
                        <div>{{ $post->published_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 text-sm">
                <x-topic-icon :topic="$post->topic" />
            </div>
        </div>
    </div>

    @if ($post->illustration)
        <div class="flex justify-center">
            <img class="max-h-[400px] rounded-xl object-cover" src="{{ $post->illustration }}" />
        </div>
    @endif

    @if ($post->intro)
        <div class="dark:text-gray-100 line-clamp-3 text-gray-900">
            {{ $post->intro }}
        </div>
    @endif

    <div class="mt-1 flex items-center justify-between pe-1">
        <div class="flex items-center gap-4 space-x-2 text-xs font-semibold text-gray-400">
            <x-like-button :post="$post" />
            <x-comment-button :post="$post" />
        </div>

        <div class="flex items-center gap-4 text-gray-400">
            <x-views-count-indicator :post="$post" />
            <x-bookmark-button :post="$post" />
        </div>
    </div>
</div>
