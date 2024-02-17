@props(['post'])

<a href="{{ $link }}" class="flex cursor-pointer items-center gap-x-1 text-sm hover:text-black" @click.stop="">
    <x-icons.comment class="h-6 w-6" />
    <span>{{ $post->comments_count }}</span>
</a>
