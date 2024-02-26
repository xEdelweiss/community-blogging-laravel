<x-dropdown align="right">
    <x-slot name="trigger">
        <x-minimal-button
            class="pt-1/2 pb-1/2 relative h-7 rounded-full border bg-gray-100 px-3 font-normal transition duration-150 ease-in hover:bg-gray-200">
            <x-icons.chevron-down class="h-4 w-4" />
            <span>{{ $scores[$selected] }}</span>
        </x-minimal-button>
    </x-slot>

    <x-slot name="content">
        @foreach ($scores as $value => $label)
            <x-dropdown-link
                class="{{ request('score', \App\Enums\MinLikesScore::None->value) === $value ? 'bg-gray-100 dark:bg-gray-800' : '' }} flex gap-x-2"
                href="{{ routeWith(['score' => $value]) }}">
                {{ __($label) }}
            </x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>
