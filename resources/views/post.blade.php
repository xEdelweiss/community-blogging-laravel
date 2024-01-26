<x-main-layout>

    <div class="dark:bg-gray-800 flex flex-col gap-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
        <div class="mb-2 flex items-center justify-between">
            <div class="flex items-center space-x-2 font-semibold text-gray-400">
                <x-avatar :user="$post->author" />

                <div>
                    <div class="text-sm font-bold text-gray-900 hover:text-primary">
                        <a href="#">{{ $post->author->name }}</a>
                    </div>

                    <div class="text-xs">{{ __('Posted on') }} <time
                            datetime="{{ $post->published_at->toDateTimeString() }}" class="date-no-year"
                            title="{{ $post->published_at->isoFormat('LLLL') }}">{{ $post->published_at->isoFormat('ll') }}</time>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-subscribe-button :post="$post" />
            </div>
        </div>

        <div>
            <div class="@if ($post->title) items-start @else items-start @endif flex justify-between">
                <div>
                    <div
                        class="flex gap-2 text-sm leading-none opacity-75 transition duration-150 ease-in hover:opacity-100">
                        <a href="#" class="hover:text-primary">#lorem</a>
                        <a href="#" class="hover:text-primary">#ipsum</a>
                        <a href="#" class="hover:text-primary">#dolor</a>
                    </div>

                    @if ($post->title)
                        <h1 class="text-3xl font-semibold leading-snug">
                            {{ $post->title }}
                        </h1>
                    @endif
                </div>

                <x-topic-icon :topic="$post->topic" />
            </div>
        </div>

        @if ($post->intro)
            <div class="dark:text-gray-100 text-gray-900">
                {{ $post->intro }}
            </div>
        @endif

        @if ($post->illustration)
            <div class="flex justify-center">
                <img class="max-h-[400px] rounded-xl object-cover" src="{{ $post->illustration }}" />
            </div>
        @endif

        <div class="dark:text-gray-100 text-gray-900">
            <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. At ab voluptas enim aperiam vitae
                sed recusandae quod? Enim deserunt quas, beatae, amet aliquam perspiciatis modi sapiente asperiores
                eveniet corrupti tenetur consequuntur nobis repellendus accusantium laboriosam repudiandae quod rerum ut
                debitis reiciendis reprehenderit odio at. Magni quisquam quae ab modi voluptatem.</p>

            <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo numquam tempora modi
                assumenda sapiente reiciendis harum quidem nesciunt odio, atque natus autem impedit debitis magnam
                itaque. Sunt laudantium vitae quisquam.</p>

            <p class="mb-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur explicabo nemo non
                quos possimus asperiores, nesciunt iste voluptatibus! Assumenda eius ullam commodi, nisi magnam odit
                ipsam, recusandae officiis corporis quos, adipisci accusamus exercitationem est cupiditate nulla placeat
                inventore error dolor ipsum quis deleniti corrupti sint?</p>
        </div>

        <div class="mt-1 flex items-center justify-between pe-1">
            <div class="flex items-center gap-4 space-x-2 text-xs font-semibold text-gray-400">
                <x-like-button :post="$post" />
                <x-comment-button :post="$post" />
            </div>

            <div class="flex items-center gap-4 text-gray-400">
                <x-views-count-indicator :post="$post" />
                <x-bookmark-button :post="$post" />
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-post-comments :post="$post" />
    </div>
</x-main-layout>
