@props([
    'disabled' => false,
    'name' => 'tags',
])

<!--  Input component start  -->
<div x-data="{
    key: 1,
    newItem: '',
    allSuggestions: ['Made in Ukraine', 'Підтримка України', 'Скандали', 'Розробка', 'SaaS', 'Читоголік', 'Розслідування'],
    items: ['Хтось пише', 'Агрегатор', 'Репост'],
    showSuggestions: false,
    get suggestions() {
        const regex = new RegExp(this.newItem.split('').join('.*'), 'i');
        const result = this.allSuggestions.filter(v => v.match(regex));

        if (result.length === 0) {
            result.push(this.newItem)
        }

        return result;
    },
    addItem() {
        if (this.newItem) {
            this.items.push(this.newItem)
            // @fixme this doesn't work
            this.newItem = ''
        }
    },
    addSuggestedItem(suggestedItem) {
        this.items.push(suggestedItem)
        $refs.input.focus()
    },
    removeItem(index) {
        this.items.splice(index, 1)
        $refs.input.focus()
    },
    removeLastItem() {
        if (!this.newItem) {
            this.items.pop()
        }
    }
}">
    <div class="relative" @click.outside="showSuggestions=false">
        <div class="flex flex-row">
            <template x-for="(item, index) in items">
                <input type="hidden" name="{{ $name }}[]" :value="item.toLowerCase()" />
            </template>

            <!--    Value list    -->
            <div class="flex flex-wrap gap-2 text-sm">
                <template x-for="(item, index) in items">
                    <a href="#" class="pt-2 hover:text-primary" x-text="`#${item.toLowerCase()}`" @click.prevent="removeItem(index)"></a>
                </template>

                <!--    Input element    -->
                <div>
                    <input aria-label="{{ __('Add up to 5 tags...') }}" :disabled="items.length >= 5"
                        class="border-none px-0 pt-2 text-sm text-gray-900 caret-black shadow-none focus:border-none focus:outline-none focus:ring-0 dark:text-gray-300 dark:caret-white"
                        x-ref="input" @keydown.enter.prevent="addItem" @focus="showSuggestions=(items.length < 5)"
                        @keydown.backspace="removeLastItem" type="text" x-model.debounce="newItem"
                        :placeholder="items.length < 5 ? '{{ __('Add up to 5 tags...') }}' : '{{ __('Max 5 tags used') }}'" />

                    <!--    Suggestions list    -->
                    <div class="absolute z-50 mt-2 w-48 rounded-md shadow-lg ltr:origin-top-right rtl:origin-top-left"
                        x-show="showSuggestions">
                        <div class="rounded-md bg-white py-1 ring-1 ring-black ring-opacity-5 dark:bg-gray-700">
                            <template x-for="suggestion in suggestions">
                                <button x-text="suggestion.toLowerCase()" @click.prevent="addSuggestedItem(suggestion)"
                                    class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
