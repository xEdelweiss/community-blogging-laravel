@props([
    'check' => false,
])

<span {!! $attributes->merge(['class' => 'h-5 w-5 relative mb-[2px]']) !!}>
    <svg :class="{!! $check !!} ? '' : 'opacity-0'"
        class="absolute text-green-800 transition duration-150"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="m4.5 12.75 6 6 9-13.5" />
    </svg>
    <svg :class="{!! $check !!} ? 'opacity-0' : ''"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor"
        class="absolute text-red-800 transition duration-150">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M6 18 18 6M6 6l12 12" />
    </svg>

</span>
