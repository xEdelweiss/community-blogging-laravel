<x-main-layout x-data="{ addUrlOpen: true, url: null, postContent: { type: 'doc', content: [] } }" title="✏️ {{ __('New post') }}">
    {{-- content --}}
    <form class="space-y-4 bg-white p-6 shadow-sm dark:bg-gray-800 sm:rounded-lg" action="{{ route('post.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="flex flex-col">
            <x-minimal-input class="w-full pb-0 text-4xl" placeholder="{{ __('Your catchy title..') }}" name="title" />
            <x-tags-input class="w-full text-sm" placeholder="{{ __('Add up to 5 tags..') }}" name="tags" />
        </div>

        <div class="mb-4 flex flex-col gap-3">
            <div class="flex items-center gap-3" :class="{ 'hidden': !addUrlOpen }">
                <x-text-input class="w-full" placeholder="{{ __('Your URL goes here..') }}" name="url" x-model.debounce.500ms="url" />

                <x-minimal-button x-on:click.prevent="addUrlOpen = false">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </x-minimal-button>
            </div>

            <div x-embed="url" class="w-full"></div>
        </div>

        <div class="px-2 text-gray-900 dark:text-gray-100 sm:px-0">
            <div x-post-editor="postContent">Loading..</div>
            <input :value="JSON.stringify(postContent)" type="hidden" name="content" />
        </div>
    </form>

    {{-- sidebar --}}
    <x-slot name="rightSidebar">
        <div x-data
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

            <div class="w-full text-left">
                <p class="mb-2 text-left font-semibold">
                    {{ __('Tips for a good post:') }}
                </p>
                <ul class="ms-2 list-inside list-disc">
                    <li>{{ __('Clear and concise') }}</li>
                    <li>{{ __('Well formatted') }}</li>
                    <li>{{ __('Contains code snippets') }}</li>
                    <li>{{ __('Contains images') }}</li>
                    <li>{{ __('Contains links') }}</li>
                </ul>
            </div>

            <div class="flex w-full flex-col gap-y-2">
                <img src="https://placehold.it/600x300" alt="" class="w-full cursor-pointer rounded" />

                <x-secondary-button class="flex w-full justify-center">
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    <span>{{ __('Add cover') }}</span>
                </x-secondary-button>

                <template x-if="addUrlOpen">
                    <x-secondary-button class="flex w-full justify-center" @click.prevent="addUrlOpen = false">
                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                        <span>{{ __('Remove URL') }}</span>
                    </x-secondary-button>
                </template>

                <template x-if="! addUrlOpen">
                    <x-secondary-button class="flex w-full justify-center" @click.prevent="addUrlOpen = true">
                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>

                        <span>{{ __('Add URL') }}</span>
                    </x-secondary-button>
                </template>

                <x-primary-button class="flex w-full justify-center" disabled x-bind:disabled="postContent.content.length < 2">
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                    </svg>

                    <span>{{ __('Publish') }}</span>
                </x-primary-button>

                <template x-if="postContent.content.length < 2">
                    <div class="w-full text-center text-sm text-gray-500">
                        <p>
                            {{ __('Add more content to publish') }}
                        </p>
                    </div>
                </template>
            </div>
        </div>

        <div x-data
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

            <div class="w-full text-left">
                <p class="mb-2 text-left font-semibold">
                    {{ __('Checklist:') }}
                </p>
                <ul class="ms-2 list-inside">
                    <li class="flex items-center">

                        <x-checkmark checked />
                        <span class="ml-2">{{ __('Write title') }}</span>
                    </li>
                    <li class="flex items-center">
                        <x-checkmark />
                        <span class="ml-2">{{ __('Write intro') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

            <div class="w-full text-left">
                <p class="mb-2 text-left font-semibold">
                    {{ __('Editor tips:') }}
                </p>
                <ul class="ms-2 list-inside list-disc">
                    <li>{{ __('To exit from code block use Shift+Enter') }}</li>
                </ul>
            </div>
        </div>
    </x-slot>

</x-main-layout>
