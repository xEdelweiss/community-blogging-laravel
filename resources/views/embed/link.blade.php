<figure class="flex flex-col sm:flex-row items-center sm:items-start justify-start gap-4 rounded-xl border p-4">
    @if ($image_url)
        <img class="h-24 w-full sm:w-auto sm:max-w-[30%] rounded object-cover sm:object-contain" src="{{ $image_url }}" title="{{ $title }}" alt="{{ $title }}">
    @endif

    <div class="flex flex-1 flex-col gap-2 text-left">
        <figcaption>
            <p class="text-sm font-semibold">{{ $title }}</p>
        </figcaption>

        @if ($title !== $description)
            <p class="line-clamp-2 flex-1 text-sm">{{ $description }}</p>
        @endif

        <div class="flex justify-end gap-1 opacity-75">
            <img class="h-5 w-5 rounded" src="{{ $icon_url }}" alt="${meta.provider}" title="{{ $provider }}">
            <span class="text-sm">{{ $provider }}</span>
        </div>
    </div>
</figure>
