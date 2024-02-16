@if ($withLink)
    <a href="{{ $link }}" class="{{ $linkClass }}">
        <img src="{{ $avatarUrl }}" {{ $attributes->merge(['class' => 'h-10 w-10 rounded-xl']) }} alt="{{ __('Avatar') }}" />
    </a>
@else
    <img src="{{ $avatarUrl }}" {{ $attributes->merge(['class' => 'h-10 w-10 rounded-xl']) }} alt="{{ __('Avatar') }}" />
@endif
