@props([
    'checked' => false,
])

<span {!! $attributes->merge(['class' => 'h-4 w-4 text-green-800']) !!}>
    <template x-if="{{ json_encode($checked) }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
        </svg>
    </template>
</span>
