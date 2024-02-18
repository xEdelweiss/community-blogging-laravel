<x-main-layout x-data="{
    addUrlOpen: true,
    editorOpen: false,
    url: '',
    title: '',
    maxTitleLength: 150,
    get titleIndicatorColor() {
        if (this.title.length < this.maxTitleLength * 0.4) {
            return 'bg-green-500';
        }

        if (this.title.length < this.maxTitleLength * 0.7) {
            return 'bg-yellow-500';
        }

        return 'bg-red-500';
    },
    intro: '',
    maxIntroLength: 300,
    postContent: { type: 'doc', content: [] },
    get valid() {
        return this.title.length > 0 && this.intro.length > 0 && (!this.url || this.url.contains('://'));
    },

    init() {
        $watch('postContent.content', (value) => {
            if (value.length > 0) {
                this.editorOpen = true;
            }
        });
    }
}" title="✏️ {{ __('New post') }}">

    <form action="{{ route('post.store') }}" method="post">
        <div
            class="space-y-4 bg-white p-6 shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="flex flex-col">
                {{-- title --}}
                <div class="relative">
                    <x-minimal-textarea x-bind:maxlength="maxTitleLength"
                        class="w-full resize-none overflow-hidden pb-0 text-4xl"
                        x-ref="title" x-model="title"
                        placeholder="{{ __('Your catchy title') }}"
                        name="title" no-border />

                    {{-- limit counter --}}
                    <div class="absolute -bottom-[8px] end-0 text-xs opacity-75"
                        x-show="title.length > 0">
                        <span class="align-center">
                            <span :class="titleIndicatorColor"
                                class="inline-block h-2 w-2 rounded-full"></span>
                        </span>
                        <span x-text="title.length"></span>/<span
                            x-text="maxTitleLength"></span>
                    </div>
                </div>

                {{-- tags --}}
                <livewire:post.tags-input :tags="['Переклад', 'Хмарні Технології', 'Скандали']" />
            </div>

            <x-topic-select />

            {{-- url --}}
            <div class="mb-4 flex flex-col gap-3"
                :class="{ 'hidden': !addUrlOpen }">
                <div class="flex items-center gap-3">
                    <x-minimal-input class="w-full"
                        placeholder="{{ __('URL to embed (optional)') }}"
                        name="url" x-model.debounce.500ms="url" />
                </div>

                <div x-embed="url"
                    x-on:embed-loaded="console.log('got dispatched event', $event); $refs.title.value = $refs.title.value || $event.detail.embed.title.substring(0, maxTitleLength); $refs.title.dispatchEvent(new Event('input'));"
                    class="w-full"></div>
            </div>

            {{-- intro textarea --}}
            <div class="relative flex flex-col gap-3">
                <x-minimal-textarea x-bind:maxlength="maxIntroLength"
                    rows="4"
                    class="w-full resize-none overflow-hidden pb-0"
                    x-ref="intro" x-model="intro"
                    placeholder="{{ __('Add intro text to make your post more attractive and get better preview') }}"
                    name="intro" />

                {{-- limit counter --}}
                <div class="absolute -bottom-[8px] end-0 text-xs opacity-75"
                    x-show="intro.length > 0">
                    <span x-text="intro.length"></span>/<span
                        x-text="maxIntroLength"></span>
                </div>
            </div>

            <div x-show="editorOpen"
                class="border border-transparent border-l-gray-200 px-2 ps-3 text-gray-900 focus-within:border-l-primary dark:text-gray-100">
                <div x-post-editor="postContent" x-ref="editor">Loading…</div>
                <input :value="JSON.stringify(postContent)" type="hidden"
                    name="content" />
            </div>
            <div x-show="!editorOpen" class="flex flex-row-reverse">
                <x-minimal-button class="gap-x-2"
                    x-on:click="editorOpen = true; $nextTick(() => $refs.editor.dispatchEvent(new Event('editor-open')))">
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
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

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
                    disabled x-bind:disabled="!valid">
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
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

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
            class="flex flex-col items-center justify-between gap-y-4 rounded-xl bg-white px-5 py-4 text-center text-black transition-colors duration-300">

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
