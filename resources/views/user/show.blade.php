<x-main-layout title="{{ $user->name }}">

    {{-- content --}}
    <header class="mb-4 flex flex-wrap justify-start gap-x-4 px-3 sm:px-0">
        <a href="#"
            class="px-3 py-1 hover:text-primary">{{ __('About') }}</a>
        <a href="#"
            class="overflow-hidden rounded-lg bg-white px-3 py-1 shadow-sm hover:text-primary dark:bg-gray-800">{{ __('Posts') }}</a>
        <a href="#"
            class="px-3 py-1 hover:text-primary">{{ __('Comments') }}</a>
    </header>

    <div class="flex flex-col gap-6">
        @foreach ($posts as $post)
            <x-post-preview :post="$post" noAuthor />
        @endforeach

        @if ($posts->hasPages())
            <div class="pagination flex justify-center gap-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    {{-- sidebar --}}
    <x-slot name="rightSidebar">
        <div x-data
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

            <x-avatar :user="$user" class="mb-1 w-full h-full rounded-xl" />

            <div class="flex flex-col items-center gap-2">
                <div class="text-lg font-semibold leading-none">
                    {{ $user->name }}
                </div>

                <div class="text-sm leading-snug text-gray-400">
                    @if ($user->posts->count() > 0)
                        Author of <span
                            class="font-semibold">{{ $user->posts->count() }}</span>
                        posts
                    @else
                        No posts yet
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
