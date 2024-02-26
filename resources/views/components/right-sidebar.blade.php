<div class="sticky top-[40px]">
    <div class="pb-15 max-h-screen space-y-4 overflow-auto">
        {{ $slot }}

        {{-- dummy block --}}
        <a class="inherits-color block flex-1" href="/">
            <div
                class="panel light right-sidebar-card relative flex flex-col items-center justify-between gap-y-4 px-8 py-4 text-center text-black">
                <div class="flex flex-col items-center">
                    <x-application-mini-logo class="h-[85px] w-[85px]" />

                    <div class="mt-3 flex-1">
                        <h5
                            class="clamp one-line font-poppins text-sm font-semibold tracking-normal dark:text-white xl:text-sm">
                            Spilka is about sharing
                        </h5>
                        <p class="dark:text-grey-100 mt-1 text-[11px]">
                            We are a community of people who values open and
                            respectful conversations. We believe that
                            everyone has something to contribute.
                        </p>
                    </div>
                </div>

                <a href="{{ auth()->check() ? route('post.create') : route('register') }}"
                    class="text-grey-800 dark:text-grey-600 w-full w-full max-w-[200px] rounded-xl bg-black/10 px-4 py-2 text-center text-[11px] font-medium leading-loose dark:bg-blue-700/10 2xl:text-xs">
                    Join the conversation
                </a>
            </div>
        </a>
    </div>
</div>
