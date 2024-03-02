<div {{ $attributes }} class="absolute -bottom-[8px] end-0 text-xs opacity-75"
    x-show="value.length > 0">
    <span class="align-center">
        <span :class="indicatorColor"
            class="inline-block h-2 w-2 rounded-full"></span>
    </span>
    <span x-text="value.length"></span>/<span x-text="limit"></span>
</div>
