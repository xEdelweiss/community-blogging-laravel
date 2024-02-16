@props(['disabled' => false, 'noBorder' => false])

<textarea x-autosize {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'rows' => 1,
    'class' =>
        'dark:caret-white border-transparent border-t-0 border-b-0 px-0 text-gray-900 caret-black shadow-none focus:border-transparent focus:outline-none focus:ring-0 dark:text-gray-300' .
        ($noBorder ? '' : ' focus:border-l-primary border-l-gray-200 ps-3'),
]) !!}></textarea>
