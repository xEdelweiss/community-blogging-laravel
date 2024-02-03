<x-main-layout title="{{ $user->name }}">
    {{-- content --}}
    <header class="mb-4 flex flex-wrap justify-start gap-x-4 px-3 sm:px-0">
        <a href="#" class="px-3 py-1 hover:text-primary">{{ __('About') }}</a>
        <a href="#"
            class="dark:bg-gray-800 overflow-hidden rounded-lg bg-white px-3 py-1 shadow-sm hover:text-primary">{{ __('Posts') }}</a>
        <a href="#" class="px-3 py-1 hover:text-primary">{{ __('Comments') }}</a>
    </header>

    <div class="flex flex-col gap-6">
        @foreach ($posts as $post)
            <x-post-preview :post="$post" noAuthor />
        @endforeach

        @if ($posts->hasPages())
            <div class="flex justify-center gap-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    {{-- sidebar --}}
    <x-slot name="rightSidebar">
        <div x-data
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

            <img src="https://source.unsplash.com/200x200/?face&crop=face&v={{ $user->id }}" alt="avatar"
                class="mb-1 w-full rounded-xl" />

            <div class="flex flex-col items-center gap-2">
                <div class="text-lg font-semibold leading-none">
                    {{ $user->name }}
                </div>

                <div class="text-sm leading-snug text-gray-400">
                    @if ($user->posts->count() > 0)
                        Author of <span class="font-semibold">{{ $user->posts->count() }}</span> posts
                    @else
                        No posts yet
                    @endif
                </div>

            </div>

            <div class="flex w-full flex-col">
                <x-subscribe-button primary :user="$user" class="mb-1 flex w-full justify-center" />

                <x-secondary-button class="flex w-full justify-center">
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>

                    <span>{{ __('Message') }}</span>
                </x-secondary-button>

                <x-secondary-button class="flex w-full justify-center">
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>

                    <span>{{ __('Block') }}</span>
                </x-secondary-button>

                <x-secondary-button class="flex w-full justify-center">
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                    </svg>

                    <span>{{ __('Report') }}</span>
                </x-secondary-button>
            </div>
        </div>
    </x-slot>
</x-main-layout>
