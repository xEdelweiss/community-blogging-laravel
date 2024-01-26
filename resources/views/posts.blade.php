<x-main-layout>
    <header class="mb-4 flex flex-wrap justify-start gap-x-4 px-3 sm:px-0">
        <a href="#" class="px-3 py-1 hover:text-primary">{{ __('Relevant') }}</a>
        <a href="#"
            class="dark:bg-gray-800 overflow-hidden rounded-lg bg-white px-3 py-1 shadow-sm hover:text-primary">{{ __('Latest') }}</a>
        <a href="#" class="px-3 py-1 hover:text-primary">{{ __('Top') }}</a>
    </header>

    <div class="flex flex-col gap-6">
        @foreach ($posts as $post)
            @php
                // dd($post->toArray());
            @endphp
            <x-post-preview :post="$post" />
        @endforeach

        <div class="flex justify-center gap-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-main-layout>
