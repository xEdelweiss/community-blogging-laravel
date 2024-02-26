<x-main-layout title="✏️ {{ __('New post') }}" x-data="postForm">
    <form x-ref="form" @post-form-submit.window="submitForm()"
        action="{{ route('post.store') }}" method="post">
        <div class="main-card space-y-4 p-6 shadow-sm dark:bg-gray-800">
            @csrf

            <div class="flex flex-col">
                {{-- title --}}
                <div class="relative">
                    <x-minimal-textarea x-bind:maxlength="maxTitleLength"
                        x-ref="title" x-model="title"
                        class="w-full resize-none overflow-hidden pb-0 text-4xl"
                        placeholder="{{ __('Your catchy title') }}"
                        name="title" no-border />

                    <x-text-limit-indicator x-data="limit(maxTitleLength)"
                        x-limit-value="title" />
                </div>

                {{-- tags --}}
                <livewire:post.tags-input :tags="['Переклад', 'Хмарні Технології', 'Скандали']" />
            </div>

            <x-topic-select />

            {{-- url --}}
            <div class="mb-4 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <x-minimal-input class="w-full"
                        placeholder="{{ __('URL to embed (optional)') }}"
                        name="url" x-model.debounce.500ms="url" />
                </div>

                <div x-embed="url"
                    @embed-loaded="updateTitle($event.detail.embed.title)"
                    class="w-full"></div>
            </div>

            {{-- intro textarea --}}
            <div class="relative flex flex-col gap-3">
                <x-minimal-textarea x-bind:maxlength="maxIntroLength"
                    x-ref="intro" x-model="intro" rows="4"
                    class="w-full resize-none overflow-hidden pb-0"
                    placeholder="{{ __('Add intro text to make your post more attractive and get better preview') }}"
                    name="intro" />

                {{-- limit counter --}}
                <x-text-limit-indicator x-data="limit(maxIntroLength)"
                    x-limit-value="intro" />
            </div>

            <div x-show="editorOpen"
                class="border border-transparent border-l-gray-200 px-2 ps-3 text-gray-900 focus-within:border-l-primary dark:text-gray-100">
                <div x-post-editor="postContent" x-ref="editor">Loading…</div>
                <input :value="JSON.stringify(postContent)" type="hidden"
                    name="content" />
            </div>
            <div x-show="!editorOpen" class="flex flex-row-reverse">
                <x-minimal-button class="gap-x-2" @click="openEditor()">
                    <x-icons.pen class="h-4 w-4" with-paper />
                    <span class="h-4">{{ __('Add more content') }}</span>
                </x-minimal-button>
            </div>
        </div>

        <div class="mt-4 flex w-full flex-col gap-y-2 px-4 sm:hidden">
            <x-primary-button class="mr-2 flex w-full justify-center" disabled
                x-bind:disabled="!valid">

                <x-icons.publish class="h-4 w-4" />
                <span>{{ __('Publish') }}</span>
            </x-primary-button>

            <template x-if="!valid">
                <div class="w-full text-center text-sm text-gray-500">
                    <p>
                        {{ __('Add more content to publish') }}
                    </p>
                </div>
            </template>
        </div>

    </form>

    {{-- sidebar --}}
    <x-slot name="rightSidebar">
        <div x-data
            class="right-sidebar-card flex flex-col items-center justify-between gap-y-4 px-5 py-4 text-center text-black transition-colors duration-300">

            <div class="w-full text-left">
                <p class="mb-2 text-left font-semibold">
                    {{ __('Tips for a good post:') }}
                </p>
                <ul class="ms-2 list-inside list-disc">
                    <li>{{ __('Write concise title') }}</li>
                    <li>{{ __('Add intro text') }}</li>
                    <li>{{ __('Choose correct topic') }}</li>
                    <li>{{ __('Add relevant tags') }}</li>
                </ul>
            </div>

            <div class="flex w-full flex-col gap-y-2">
                <x-secondary-button disabled title="{{ __('Not ready') }}"
                    class="flex w-full justify-center gap-x-2">
                    <x-icons.image class="h-4 w-4" />
                    <span class="h-4">{{ __('Add cover') }}</span>
                </x-secondary-button>

                <x-primary-button class="flex w-full justify-center gap-x-2"
                    @click.prevent="$dispatch('post-form-submit')" disabled
                    x-bind:disabled="!valid">
                    <x-icons.publish class="h-4 w-4" />
                    <span>{{ __('Publish') }}</span>
                </x-primary-button>

                <template x-if="!valid">
                    <div class="w-full text-center text-sm text-gray-500">
                        <p>
                            {{ __('Add more content to publish') }}
                        </p>
                    </div>
                </template>
            </div>
        </div>

        <div x-data
            class="right-sidebar-card flex flex-col items-center justify-between gap-y-4 px-5 py-4 text-center text-black transition-colors duration-300">

            <div class="w-full text-left">
                <p class="mb-2 text-left font-semibold">
                    {{ __('Checklist:') }}
                </p>
                <ul class="list-inside">
                    <li class="flex items-center">
                        <x-checkmark check="title.length > 0" />
                        <span class="ml-2">{{ __('Has title') }}</span>
                    </li>
                    <li class="flex items-center">
                        <x-checkmark check="intro.length > 0" />
                        <span
                            class="ml-2">{{ __('Has intro or link') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="right-sidebar-card flex flex-col items-center justify-between gap-y-4 px-5 py-4 text-center text-black transition-colors duration-300">

            <div class="w-full text-left">
                <p class="mb-2 text-left font-semibold">
                    {{ __('Editor tips:') }}
                </p>
                <ul class="ms-2 list-inside list-disc">
                    <li>{{ __('To exit from code block use Shift+Enter') }}
                    </li>
                </ul>
            </div>
        </div>
    </x-slot>

</x-main-layout>
