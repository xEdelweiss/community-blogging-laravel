<div
    class="flex flex-col items-start justify-between rounded-xl bg-white py-5 text-center text-black transition-colors duration-300">

    <div class="px-4 pb-4 pt-1 text-lg font-semibold leading-none">
        {{ __('Active discussions') }}
    </div>

    <div class="flex w-full flex-col gap-y-3">
        @foreach ($posts as $post)
            <hr class="w-full border-b-2 border-gray-100" />

            <a href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug ?? 'none']) }}"
               class="group flex flex-col gap-1 px-4 text-left">
                <span
                    class="line-clamp-2 leading-snug group-hover:text-primary">{{ $post->title }}</span>

                <div class="text-sm font-semibold text-gray-400">
                    {{ random_int(100, 250) }} comments
                </div>
            </a>
        @endforeach
    </div>
</div>
