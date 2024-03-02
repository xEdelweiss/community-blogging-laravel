@props(['primary' => false])

@if ($primary)
    <x-primary-button {{ $attributes->merge(['class' => 'gap-x-2']) }}>
        <x-icons.add-user class="h-4 w-4" />
        <span>{{ __('Subscribe') }}</span>
    </x-primary-button>
@else
    <x-secondary-button {{ $attributes->merge(['class' => 'gap-x-2']) }}>
        <x-icons.add-user class="h-4 w-4" />
        <span>{{ __('Subscribe') }}</span>
    </x-secondary-button>
@endif
