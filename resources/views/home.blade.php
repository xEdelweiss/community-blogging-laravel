<x-main-layout>
    {{-- content --}}
    <header class="mb-4 flex flex-wrap justify-start gap-x-4 px-3 sm:px-0">
        @auth()
            <a href="#"
                class="px-3 py-1 hover:text-primary">{{ __('Relevant') }}</a>
        @endauth

        <a href="#"
            class="overflow-hidden rounded-lg bg-white px-3 py-1 shadow-sm hover:text-primary dark:bg-gray-800">{{ __('Latest') }}</a>
        <a href="#"
            class="px-3 py-1 hover:text-primary">{{ __('Top') }}</a>
    </header>

    <div class="flex flex-col gap-6">
        @foreach ($posts as $post)
            <x-post-preview :post="$post" />
        @endforeach

        @if ($posts->hasPages())
            <div class="pagination flex justify-center gap-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    {{-- sidebar --}}
    <x-slot name="rightSidebar">

        {{-- heated discussions --}}
        <div
            class="flex flex-col items-start justify-between rounded-xl bg-white py-5 text-center text-black transition-colors duration-300">

            <div class="px-4 pb-4 pt-1 text-lg font-semibold leading-none">
                {{ __('Active discussions') }}
            </div>

            <div class="flex w-full flex-col gap-y-3">
                @foreach ($likedPosts as $post)
                    <hr class="w-full border-b-2 border-gray-100" />

                    <a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug ?? 'none']) }}"
                        class="group flex flex-col gap-1 px-4 text-left">
                        <span
                            class="line-clamp-2 leading-snug group-hover:text-primary">{{ $post->title }}</span>

                        <div class="text-sm font-semibold text-gray-400">
                            {{ random_int(100, 250) }} comments</div>
                    </a>
                @endforeach
            </div>
        </div>
    </x-slot>
</x-main-layout>
