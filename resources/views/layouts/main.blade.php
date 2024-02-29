@props([
    'title' => null,
])
<x-app-layout :title="$title">
    <div
        {{ $attributes->merge(['class' => 'mx-auto grid grid-cols-4 gap-4 lg:gap-6 xl:gap-10 md:grid-cols-12 xl:grid-cols-14 2xl:grid-cols-18 max-w-[1400px]']) }}>

        <x-left-sidebar class="xl:col-span-3">
            <x-topics-sidebar />
        </x-left-sidebar>

        <main class="col-span-4 md:col-span-8 xl:col-span-8 2xl:col-span-11">
            {{ $slot }}
        </main>

        <div class="col-span-4 hidden md:block xl:col-span-3 2xl:col-span-4">
            <x-right-sidebar>
                @if (isset($rightSidebar))
                    {{ $rightSidebar }}
                @endif
            </x-right-sidebar>
        </div>
    </div>
</x-app-layout>
