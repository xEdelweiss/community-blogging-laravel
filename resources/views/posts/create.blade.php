<x-main-layout>
    <div x-data="{ addUrlOpen: false }"
        class="dark:bg-gray-800 flex flex-col gap-3 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

        <div class="flex items-center justify-between gap-4">
            <div class="flex flex-1 items-center space-x-2 font-semibold text-gray-400">
                <x-text-input class="w-full" placeholder="Title" />
            </div>

            <div class="flex items-center gap-3">
                <x-primary-button>
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                    </svg>

                    <span>Publish</span>
                </x-primary-button>
            </div>
        </div>

        <template x-if="addUrlOpen">
            <div class="flex items-center gap-3">
                <x-text-input class="w-full" placeholder="Your URL goes here.." />

                <x-secondary-button x-on:click.prevent="addUrlOpen = false">
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                    <span>Del&nbsp;URL</span>
                </x-secondary-button>
            </div>
        </template>
        <template x-if="!addUrlOpen">
            <div class="flex flex-row-reverse">
                <x-secondary-button x-on:click.prevent="addUrlOpen = true">
                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>

                    <span>Add URL</span>
                </x-secondary-button>
            </div>
        </template>

        <div class="dark:text-gray-100 text-gray-900">
            <textarea rows="20" placeholder="Your content goes here.."
                class="dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
        </div>
    </div>

</x-main-layout>
