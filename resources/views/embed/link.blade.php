<figure
    class="flex flex-col items-center justify-start gap-4 rounded-xl border p-4 sm:flex-row sm:items-start">
    @if ($meta->imageUrl)
        <img class="h-24 w-full rounded object-cover sm:w-auto sm:max-w-[30%] sm:object-contain"
            src="{{ $meta->imageUrl }}" title="{{ $meta->title }}"
            alt="{{ $meta->title }}">
    @endif

    <div class="flex flex-1 flex-col gap-2 text-left">
        <figcaption>
            <p class="text-sm font-semibold">{{ $meta->title }}</p>
        </figcaption>

        @if ($meta->title !== $meta->description)
            <p class="line-clamp-2 flex-1 text-sm">{{ $meta->description }}</p>
        @endif

        <div class="flex justify-end gap-1 opacity-75">
            <img class="h-5 w-5 rounded" src="{{ $meta->iconUrl }}"
                alt="${meta.provider}" title="{{ $meta->providerName }}">
            <span class="text-sm">{{ $meta->providerName }}</span>
        </div>
    </div>
</figure>
