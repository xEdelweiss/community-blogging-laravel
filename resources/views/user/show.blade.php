<x-main-layout title="{{ $user->name }}">

    {{-- content --}}
    <header class="mb-4 flex flex-wrap justify-start gap-x-4 px-3 sm:px-0">
        <a href="#"
            class="px-3 py-1 hover:text-primary">{{ __('About') }}</a>
        <a href="{{ route('user.show', ['user' => $user->id]) }}"
            class="@if (request()->routeIs('user.show')) bg-white shadow-sm overflow-hidden rounded-lg dark:bg-gray-800 @endif px-3 py-1 hover:text-primary">{{ __('Posts') }}</a>
        <a href="#"
            class="px-3 py-1 hover:text-primary">{{ __('Comments') }}</a>
        @auth()
            @if (auth()->user()->is($user))
                <a href="{{ route('user.bookmarks', ['user' => $user->id]) }}"
                    class="@if (request()->routeIs('user.bookmarks')) bg-white shadow-sm overflow-hidden rounded-lg dark:bg-gray-800 @endif px-3 py-1 hover:text-primary">{{ __('Bookmarks') }}</a>
            @endif
        @endauth
    </header>

    <div class="flex flex-col gap-6">
        @foreach ($posts as $post)
            <x-post.preview :post="$post" :user-like="$likesByPost->get($post->id)"
                :like-count="$likesScoresByPost->get($post->id, 0)" noAuthor />
        @endforeach

        @empty($posts->count())
            <div class="mt-4 flex flex-col items-center justify-center gap-4">
                <span class="text-4xl">🫢</span>
                <div class="text-lg font-semibold text-gray-400">
                    @if (request()->routeIs('user.bookmarks'))
                        {{ __('No bookmarks yet') }}
                    @else
                        {{ __('No posts yet') }}
                    @endif
                </div>
            </div>
        @endempty

        @if ($posts->hasPages())
            <div class="pagination flex justify-center gap-4">
                {{ $posts->links('pagination::simple-tailwind') }}
            </div>
        @endif
    </div>

    {{-- sidebar --}}
    <x-slot name="rightSidebar">
        <div x-data
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

            <x-avatar :user="$user" class="mb-1 h-full w-full rounded-xl" />

            <div class="flex flex-col items-center gap-2">
                <div class="text-lg font-semibold leading-none">
                    {{ $user->name }}
                </div>

                <div class="text-sm leading-snug text-gray-400">
                    @if ($user->posts->count() > 0)
                        {!! __('Author of :tag-open:count:tag-close posts', [
                            'tag-open' => '<span class="font-semibold">',
                            'count' => $user->posts->count(),
                            'tag-close' => '</span>',
                        ]) !!}
                    @else
                        {{ __('No posts yet') }}
                    @endif
                </div>

            </div>

            <div class="flex w-full flex-col">
                <x-subscribe-button primary :user="$user"
                    class="mb-1 flex w-full justify-center" />

                <x-secondary-button class="flex w-full justify-center gap-x-2">
                    <x-icons.mail class="h-4 w-4" />
                    <span>{{ __('Message') }}</span>
                </x-secondary-button>

                <x-secondary-button class="flex w-full justify-center gap-x-2">
                    <x-icons.block class="h-4 w-4" />
                    <span>{{ __('Block') }}</span>
                </x-secondary-button>

                <x-secondary-button class="flex w-full justify-center gap-x-2">
                    <x-icons.flag class="h-4 w-4" />
                    <span>{{ __('Report') }}</span>
                </x-secondary-button>
            </div>
        </div>
    </x-slot>
</x-main-layout>
