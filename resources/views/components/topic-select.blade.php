@props([
    'disabled' => false,
    'name' => 'topic_id',
])

<div x-data="{
            selectedTopic: null,
            filter: '',
            topics: {{ json_encode(\App\Models\Topic::all()->toArray()) }},
            select(topic) {
                this.selectedTopic = topic;
                this.filter = topic.title;
            },
            get sortedTopics() {
                return this.topics.sort((a, b) => {
                    const lowerA = a.title.toLowerCase();
                    const lowerB = b.title.toLowerCase();
                    const lowerFilter = this.filter.toLowerCase();

                    if (lowerA.startsWith(lowerFilter)) {
                        return -1;
                    }

                    if (lowerB.startsWith(lowerFilter)) {
                        return 1;
                    }

                    if (lowerA.includes(lowerFilter)) {
                        return -1;
                    }

                    if (lowerB.includes(lowerFilter)) {
                        return 1;
                    }

                    return 0;
                });
            }
        }" x-init="$watch('filter', value => {
            if (!topics.find(topic => topic.title.toLowerCase() === value.toLowerCase())) {
                selectedTopic = null;
                console.log('filter changed', value);
            }
        })">
    {{-- category dropdown --}}
    <input type="hidden" :value="selectedTopic ? selectedTopic.id : null" name="topic_id" />
    <x-dropdown align="left">
        <x-slot name="trigger">
            <div
                class="items-center pb-2 flex gap-x-2 border border-transparent border-l-gray-200 ps-3 focus-within:border-l-primary">
                <template x-if="selectedTopic">
                    <img class="h-6 w-6"
                         :src="selectedTopic?.image"
                         :alt="selectedTopic?.title" />
                </template>
                <x-minimal-input no-border class="w-full pb-0"
                                 @keydown.backspace="if (selectedTopic) { selectedTopic = null; filter = ''; }"
                                 placeholder="{{ __('Select topic') }}"
                                 x-model="filter" />
            </div>
        </x-slot>

        <x-slot name="content">
            <template x-for="topic in sortedTopics">
                <x-dropdown-link @click.prevent="select(topic)"
                                 href="#"
                                 class="flex items-center justify-start gap-x-2">
                    <img class="h-6 w-6"
                         :src="topic.image"
                         :alt="topic.title" />
                    <span class="pt-1" x-text="topic.title"></span>
                </x-dropdown-link>
            </template>
        </x-slot>
    </x-dropdown>
</div>
