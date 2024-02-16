<div {{ $attributes->merge(['class' => 'relative']) }}>
    <div
        class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
        <x-icons.search class="h-4 w-4 text-gray-500 dark:text-gray-400" />
        <span class="sr-only">{{ __('Search icon') }}</span>
    </div>

    <input wire:model="search" type="text" id="search-navbar"
        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-10 text-sm text-gray-900 transition duration-150 ease-in-out focus:border-primary focus:ring-primary dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary dark:focus:ring-primary"
        placeholder="{{ __('Search…') }}" aria-label="{{ __('Search') }}">

</div>
