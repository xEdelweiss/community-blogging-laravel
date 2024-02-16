<div {{ $attributes->merge(['class' => 'flex shrink-0 items-center gap-3 text-sm']) }}>
    <a href="{{ $link }}" title="{{ $topic->title ?? 'None' }}">
        <img class="h-6 w-6" src="{{ asset($topic->image) }}" alt="">
    </a>
</div>
