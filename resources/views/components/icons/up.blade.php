@props([
    'micro' => false,
])

@if ($micro)
    <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 16 16" fill="currentColor"
        class="h-4 w-4 cursor-pointer stroke-gray-400 hover:fill-green-700 hover:stroke-green-700">
        <path fill-rule="evenodd"
            d="M8 14a.75.75 0 0 1-.75-.75V4.56L4.03 7.78a.75.75 0 0 1-1.06-1.06l4.5-4.5a.75.75 0 0 1 1.06 0l4.5 4.5a.75.75 0 0 1-1.06 1.06L8.75 4.56v8.69A.75.75 0 0 1 8 14Z"
            clip-rule="evenodd" />
    </svg>
@else
    <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
    </svg>
@endif
