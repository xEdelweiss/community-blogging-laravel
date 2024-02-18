@props([
    'disabled' => false,
    'name' => 'tags',
])

<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new class extends Component {
    public array $tags = [];

    public string $query = '';
    public array $suggestions = [];

    public function mount(array $tags): void
    {
        $this->tags = $tags;
        $this->suggestions = $this->fetchTags('', $tags);
    }

    public function updatedQuery(): void
    {
        $suggestions = $this->fetchTags($this->query, $this->tags);

        $this->suggestions = empty($suggestions) ? [$this->query] : $suggestions;
    }

    public function updatedTags(): void
    {
        $this->suggestions = $this->fetchTags($this->query, $this->tags);
    }

    private function fetchTags(string $query = '', array $existing = []): array
    {
        $existing = array_map('mb_strtolower', $existing);
        $allTags = array_map('mb_strtolower', ['Made in Ukraine', 'Підтримка України', 'Скандали', 'Розробка', 'SaaS', 'Читоголік', 'Розслідування']);

        $tags = array_filter($allTags, fn($tag) => !in_array($tag, $existing));

        if (empty($query)) {
            return $tags;
        }

        return array_values(
            array_filter($tags, function ($suggestion) {
                return Str::contains(Str::lower($suggestion), Str::lower($this->query));
            }),
        );
    }
}; ?>

<div class="relative" x-data="{
    key: 1,
    open: false,
    tags: @entangle('tags').live,
    query: @entangle('query').live,
    suggestions: @entangle('suggestions'),
    addTag(tag) {
        if (tag && this.tags.length < 5) {
            this.tags.push(tag);
        }

        if (this.tags.length >= 5) {
            this.query = '';
            this.open = false;
        }
    },
    addQueryAsTag() {
        this.addTag(this.query);
    },
    addSuggestedTag(tag) {
        this.query = '';
        this.addTag(tag);
    },
    removeLastTag() {
        if (!this.query && this.tags.length > 0) {
            this.tags.pop();
        }
    },
    removeTag(tag) {
        this.tags = this.tags.filter(t => t !== tag);
    }
}" @click.outside="open = false"
    @close.stop="open = false">
    <div class="flex flex-row">
        <template x-for="tag in tags">
            <input type="hidden" name="{{ $name }}[]"
                :value="tag.toLowerCase()" />
        </template>

        <!--    Value list    -->
        <div class="flex flex-wrap gap-x-2 text-sm">
            <template x-for="tag in tags">
                <a href="#"
                    class="group flex pt-2 align-baseline hover:text-primary-dark"
                    @click.prevent="removeTag(tag)">
                    <span class="hidden group-hover:inline-block">
                        <x-icons.cross class="inline-block h-3 w-3" />
                    </span>
                    <span class="inline-block group-hover:hidden">
                        <x-icons.hash
                            class="inline-block h-3 w-3 text-primary-dark" />
                    </span>
                    <span x-text="tag.toLowerCase()"></span>
                </a>
            </template>

            <!--    Input element    -->
            <div>
                <input aria-label="{{ __('Add up to 5 tags…') }}"
                    :disabled="tags.length >= 5"
                    class="border-none px-0 pt-2 text-sm text-gray-900 caret-black shadow-none focus:border-none focus:outline-none focus:ring-0 dark:text-gray-300 dark:caret-white"
                    x-ref="input" @focus="open=(tags.length < 5)"
                    type="text" x-model.debounce="query"
                    @keydown.enter.prevent="addQueryAsTag()"
                    @keydown.backspace="removeLastTag()"
                    :placeholder="tags.length < 5 ? '{{ __('Add up to 5 tags…') }}' :
                        '{{ __('Max 5 tags used') }}'" />

                <!--    Suggestions list    -->
                <div x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute z-50 mt-2 w-48 rounded-md shadow-lg ltr:origin-top-right rtl:origin-top-left"
                    style="display: none;">
                    <div
                        class="rounded-md bg-white py-1 ring-1 ring-black ring-opacity-5 dark:bg-gray-700">
                        <template x-for="suggestion in suggestions">
                            <a href="#"
                                class='block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800'
                                x-text="suggestion.toLowerCase()"
                                @click.prevent="addSuggestedTag(suggestion)"></a>
                        </template>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
