@props([
    'micro' => false,
])

@if ($micro)
    <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 16 16" fill="currentColor">
        <path fill-rule="evenodd"
            d="M8 2a.75.75 0 0 1 .75.75v8.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.22 3.22V2.75A.75.75 0 0 1 8 2Z"
            clip-rule="evenodd" />
    </svg>
@else
    <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
    </svg>
@endif
