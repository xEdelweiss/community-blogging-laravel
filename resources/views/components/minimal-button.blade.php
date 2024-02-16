<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'flex group items-center justify-center border text-sm font-semibold rounded-md disabled:opacity-50 whitespace-nowrap bg-transparent border-transparent text-gray-700 dark:text-gray-300 hover:bg-black/5 hover:text-neutral-700 active:bg-black/10 active:text-neutral-800 dark:hover:bg-white/10 dark:hover:text-neutral-300 dark:active:text-neutral-200 h-8 gap-1 min-w-[2rem] px-2 w-auto']) }}>
    {{ $slot }}
</button>
