@php
    $title = $meta->title ?? $meta->url;
    $description = $meta->description;

    if (!$description && $title !== $meta->url) {
        $description = $meta->url;
    }
@endphp
<figure provider-name="{{ $meta->providerName }}"
    class="relative flex flex-col items-stretch justify-start gap-4 rounded-xl border p-4 sm:flex-row">
    <a href="{{ $meta->url }}" target="__blank"
        class="absolute inset-0 z-10"></a>

    @if ($meta->imageUrl)
        <img x-hide-if-failed
            class="h-24 w-full rounded object-cover sm:w-auto sm:max-w-[30%] sm:object-contain"
            src="{{ $meta->imageUrl }}" title="{{ $title }}"
            alt="{{ $title }}">
    @endif

    <div class="flex flex-1 flex-col gap-2 text-left">
        <figcaption>
            <p class="text-sm font-semibold">{{ $title }}</p>
        </figcaption>

        @if ($description && $description !== $title)
            <p class="line-clamp-2 flex-1 text-sm">
                {{ $description }}
            </p>
        @endif

        <div class="flex justify-end gap-1 opacity-75">
            <img x-hide-if-failed class="h-5 w-5 rounded"
                src="{{ $meta->iconUrl }}" alt="${meta.provider}"
                title="{{ $meta->providerName }}">
            <span class="pt-[0.125rem] text-sm">{{ $meta->providerName }}</span>
        </div>
    </div>
</figure>
