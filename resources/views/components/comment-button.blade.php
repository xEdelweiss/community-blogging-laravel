@props(['post', 'disabled' => false])

<a @unless ($disabled) href="{{ $link }}#comments" @endunless
    class="@if ($disabled) cursor-default @else hover:text-black @endif flex items-center gap-x-1 text-sm"
    @click.stop="">
    <x-icons.comment class="h-6 w-6" />
    <span>{{ $commentsCount }}</span>
</a>
