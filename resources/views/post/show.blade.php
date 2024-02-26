<x-main-layout :title="$post->title" x-data>
    <div class="main-card flex flex-col gap-3 overflow-hidden p-6">
        <div class="mb-2 flex items-center justify-between">
            <div class="flex items-center space-x-2 font-semibold text-gray-400">
                <x-avatar :user="$post->author" with-link />

                <div>
                    <div
                        class="text-sm font-bold text-gray-900 hover:text-primary">
                        <a
                            href="{{ route('user.show', ['user' => $post->author]) }}">{{ $post->author->name }}</a>
                    </div>

                    @if (!$post->published_at)
                        <div class="text-xs">{{ __('Not published yet') }}</div>
                    @else
                        <div class="text-xs">{{ __('Posted on') }} <time
                                datetime="{{ $post->published_at->toDateTimeString() }}"
                                class="date-no-year"
                                title="{{ $post->published_at->isoFormat('LLLL') }}">{{ $post->published_at->isoFormat('ll') }}</time>
                        </div>
                    @endif
                </div>
            </div>

            @if (auth()->user() && auth()->user()->id !== $post->author->id)
                <div class="flex items-center gap-3">
                    <x-subscribe-button :user="$post->author" />
                </div>
            @endif
        </div>

        <div>
            <div
                class="@if ($post->title) items-start @else items-start @endif flex justify-between gap-x-1">
                <div>
                    <div class="mb-1 flex flex-wrap gap-x-2 text-sm sm:mb-0">
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('home', ['tag' => $tag]) }}"
                                class="flex whitespace-nowrap align-baseline opacity-50 transition duration-150 ease-in hover:text-primary hover:opacity-100">
                                <span class="inline-block">
                                    <x-icons.hash
                                        class="inline-block h-3 w-3 text-primary-dark" />
                                </span>

                                <span>{{ str($tag->name)->lower() }}</span>
                            </a>
                        @endforeach
                    </div>

                    @if ($post->title)
                        <h1 class="text-4xl font-semibold">
                            <a
                                href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug ?? 'none']) }}">{{ $post->title }}</a>
                        </h1>
                    @endif
                </div>

                <x-topic-icon :topic="$post->topic" />
            </div>
        </div>

        @if ($post->cover)
            <div class="flex justify-center">
                <img loading="lazy"
                    class="max-h-[400px] rounded-xl object-cover" alt=""
                    src="{{ $post->cover }}" />
            </div>
        @endif

        @if ($post->intro || $post->url)
            <div class="space-y-4" x-data="embedIntro({{ json_encode(nl2p($post->intro)) }})">
                @if ($post->intro)
                    <div x-bind="intro"
                        class="prose max-w-none text-gray-900 dark:text-gray-100">
                        {!! nl2p($post->intro) !!}</div>
                @endif

                @if ($post->url)
                    <div x-bind="embed" x-embed="{{ $post->url }}"
                        class="w-full"></div>
                @endif
            </div>
        @endif

        @if ($post->html)
            <div
                class="ProseMirror prose max-w-none break-words text-gray-900 dark:text-gray-100">
                {!! $post->html !!}
            </div>

            @if (app()->environment('local'))
                <pre class="whitespace-pre-wrap text-xs text-gray-400">{{ json_encode(json_decode($post->content), JSON_PRETTY_PRINT) }}</pre>
            @endif
        @endif

        <div
            class="mt-1 flex items-center justify-between pe-1 text-sm text-gray-400">
            <div class="z-20 flex items-center gap-4 space-x-2">
                <livewire:common.rating :post="$post" :user-like="$userLike"
                    :like-score="$likesScore" />
                <x-comment-button :post="$post" disabled />

                <span
                    class="rounded-full bg-gray-100 px-3 pb-1 pt-[0.375rem] text-xs text-gray-700">Editorial</span>
            </div>

            <div class="flex items-center gap-4 text-gray-400">
                <x-views-count-indicator :post="$post" />
                <x-bookmark-button :post="$post" />
            </div>
        </div>
    </div>

    <div id="comments" class="mx-auto max-w-7xl">
        <x-post.comments :post="$post" />

        @auth()
            <div
                class="comment-container-parent relative flex rounded-l-md bg-white sm:rounded-xl">
                <div class="flex w-full flex-col gap-y-3 px-5 pb-4 pt-6">
                    <form action="{{ route('comment.store') }}" method="post"
                        class="flex w-full flex-col">
                        @csrf
                        <input type="hidden" name="post_id"
                            value="{{ $post->id }}" />

                        <div class="flex flex-1 gap-x-4">
                            <div class="flex w-full flex-col justify-between">
                                <div class="flex-1 text-gray-600">
                                    <x-minimal-textarea no-border x-ref="reply"
                                        name="comment" class="w-full resize-none"
                                        rows="2"
                                        placeholder="{{ __('Write a comment...') }}" />
                                </div>
                            </div>

                            <div class="flex-none">
                                <x-avatar :user="auth()->user()" class="h-14 w-14"
                                    with-link />
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button>{{ __('Comment') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</x-main-layout>
