<x-main-layout title="{{ $title }}">
    @include('home._filter-heading')
    @include('home._order')

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

    <x-slot name="rightSidebar">
        @include('home._active-posts')
    </x-slot>
</x-main-layout>
