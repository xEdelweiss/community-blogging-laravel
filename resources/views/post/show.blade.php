<x-main-layout :title="$post->title">

    <div
        class="flex flex-col gap-3 overflow-hidden bg-white p-6 shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="mb-2 flex items-center justify-between">
            <div class="flex items-center space-x-2 font-semibold text-gray-400">
                <x-avatar :user="$post->author" />

                <div>
                    <div
                        class="text-sm font-bold text-gray-900 hover:text-primary">
                        <a
                            href="{{ route('user.show', ['user' => $post->author]) }}">{{ $post->author->name }}</a>
                    </div>

                    <div class="text-xs">{{ __('Posted on') }} <time
                            datetime="{{ $post->published_at->toDateTimeString() }}"
                            class="date-no-year"
                            title="{{ $post->published_at->isoFormat('LLLL') }}">{{ $post->published_at->isoFormat('ll') }}</time>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-subscribe-button :user="$post->author" />
            </div>
        </div>

        <div>
            <div
                class="@if ($post->title) items-start @else items-start @endif flex justify-between">
                <div>
                    <div class="flex gap-2 text-sm">
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('home', ['tag' => $tag->slug]) }}"
                                class="flex align-baseline opacity-50 transition duration-150 ease-in hover:text-primary hover:opacity-100">
                                <span class="inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="inline-block h-3 w-3 text-primary-dark">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                                    </svg>
                                </span>

                                <span>{{ str($tag->name)->lower() }}</span>
                            </a>
                        @endforeach
                    </div>

                    @if ($post->title)
                        <h1 class="text-3xl font-semibold">
                            {{ $post->title }}
                        </h1>
                    @endif
                </div>

                <x-topic-icon :topic="$post->topic" />
            </div>
        </div>

        @if ($post->intro)
            <div class="text-gray-900 dark:text-gray-100">
                {{ $post->intro }}
            </div>
        @endif

        @if ($post->cover)
            <div class="flex justify-center">
                <img loading="lazy"
                    class="max-h-[400px] rounded-xl object-cover"
                    src="{{ $post->cover }}" />
            </div>
        @endif

        <div
            class="ProseMirror prose max-w-none text-gray-900 dark:text-gray-100">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At ab
                voluptas enim aperiam vitae
                sed recusandae quod? <strong>Enim deserunt quas</strong>,
                beatae, amet aliquam perspiciatis modi sapiente asperiores
                eveniet corrupti tenetur consequuntur nobis repellendus
                accusantium laboriosam repudiandae quod rerum ut
                debitis reiciendis reprehenderit odio at. Magni quisquam quae ab
                modi voluptatem.</p>

            <p>В однобітовому монохроматичному дисплеї розміром 32 на 48
                використовуються бактерії, наповнені флуоресцентним
                білком. <strong>При цьому кожна з них діє як окремий
                    піксель.</strong> Саме завдяки цьому дисплею з дуже низькою
                роздільною
                здатністю ви
                можете відтворити ігровий процес Doom за допомогою клітин.</p>

            <p><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    <strong>Omnis, voluptatum.</strong></em></p>

            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Consequuntur explicabo nemo non
                quos possimus asperiores, nesciunt iste voluptatibus! Assumenda
                eius ullam commodi, nisi magnam odit
                ipsam, recusandae officiis corporis quos, adipisci accusamus
                exercitationem est cupiditate nulla placeat
                inventore error dolor ipsum quis deleniti corrupti sint?</p>
        </div>

        <div class="mt-1 flex items-center justify-between pe-1">
            <div
                class="flex items-center gap-4 space-x-2 text-xs font-semibold text-gray-400">
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
