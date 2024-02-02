<x-app-layout>
    <div {{ $attributes->merge(['class' => 'mx-auto flex justify-between pb-22 md:flex-row lg:gap-x-10']) }}
        style="max-width: 1400px;">

        <x-left-sidebar>
            <x-topics-sidebar />
        </x-left-sidebar>

        <main class="mx-auto w-full md:flex-1 xl:max-w-[835px]">
            {{ $slot }}
        </main>

        <x-right-sidebar>
            @if (isset($rightSidebar))
                {{ $rightSidebar }}
            @endif
        </x-right-sidebar>
    </div>
</x-app-layout>
