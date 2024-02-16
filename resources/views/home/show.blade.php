<x-main-layout title="{{ $title }}">
    @include('home._filter-heading')
    @include('home._order')

    <div class="flex flex-col gap-6">
        @foreach ($posts as $post)
            <x-post.preview :post="$post" />
        @endforeach

        @if ($posts->hasPages())
            <div class="pagination flex justify-center gap-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    <x-slot name="rightSidebar">
        <x-post.active-posts-sidebar />
    </x-slot>
</x-main-layout>
