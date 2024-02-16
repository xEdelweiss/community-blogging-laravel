@props([
    'check' => false,
])

<span {!! $attributes->merge(['class' => 'h-5 w-5 relative mb-[2px]']) !!}>
    <x-icons.checkmark ::class="{!! $check !!} ? '' : 'opacity-0'"
        class="absolute text-green-800 transition duration-150" />
    <x-icons.cross ::class="{!! $check !!} ? 'opacity-0' : ''"
        class="absolute text-red-800 transition duration-150" />
</span>
