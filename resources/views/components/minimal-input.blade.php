@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'dark:caret-white border-none px-0 text-gray-900 caret-black shadow-none focus:border-none focus:outline-none focus:ring-0 dark:text-gray-300 rounded-md',
]) !!}>
