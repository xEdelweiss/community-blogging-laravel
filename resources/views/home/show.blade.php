<x-main-layout title="{{ $title }}">
    @include('home._filter-heading')
    @include('home._order')

    <div class="flex flex-col gap-6">
        @foreach ($posts as $post)
            <x-post.preview :post="$post" :user-like="$likesByPost->get($post->id)"
                :like-count="$likesScoresByPost->get($post->id, 0)" />
        @endforeach

        @if ($posts->hasPages())
            <div class="pagination flex justify-center gap-4">
                {{ $posts->links('pagination::simple-tailwind') }}
            </div>
        @endif
    </div>

    <x-slot name="rightSidebar">
        <x-post.active-posts-sidebar />
    </x-slot>
</x-main-layout>
