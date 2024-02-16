@props(['disabled' => false, 'noBorder' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'dark:caret-white border-transparent px-0 text-gray-900 caret-black shadow-none focus:border-transparent focus:outline-none focus:ring-0 dark:text-gray-300' .
        ($noBorder ? '' : ' focus:border-l-primary border-l-gray-200 ps-3'),
]) !!}>
