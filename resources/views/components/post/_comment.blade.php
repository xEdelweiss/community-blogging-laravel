<div
    class="comment-container-parent relative flex rounded-l-md bg-white sm:rounded-xl">
    <div class="flex w-full flex-col gap-y-3 pb-4 pl-5 pr-1 pt-6">
        <div class="flex flex-1">
            <div class="flex-none">
                <x-avatar :user="$comment->author" class="h-14 w-14" with-link />
            </div>
            <div class="mx-4 flex w-full flex-col justify-between">
                <div class="flex-1 text-gray-600">
                    {{ $comment->content }}
                </div>
            </div>
        </div>

        {{-- footer --}}
        <div class="flex flex-1">
            <div class="flex-none sm:w-14"></div>

            <div class="flex flex-1 items-center justify-between sm:mx-4">
                <div
                    class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                    <div class="font-bold text-gray-900">
                        <a href="{{ route('user.show', ['user' => $comment->author]) }}"
                            class="hover:text-primary">
                            {{ $comment->author->name }}
                        </a>
                    </div>
                    <div>&bull;</div>
                    <div>
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </div>

                <div class="flex space-x-2">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <x-minimal-button
                                class="pt-1/2 pb-1/2 relative h-7 rounded-full border bg-gray-100 px-3 transition duration-150 ease-in hover:bg-gray-200">
                                <x-icons.ellipsis
                                    class="h-6 w-6 text-gray-500" />
                            </x-minimal-button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link class="flex gap-x-2"
                                href="#">
                                <x-icons.flag class="h-5 w-5" />
                                <span>{{ __('Mark as Spam') }}</span>
                            </x-dropdown-link>
                            @if (auth()->user() && auth()->user()->id === $comment->author->id)
                                <x-dropdown-link
                                    class="flex items-center gap-x-2 hover:bg-red-100 dark:hover:bg-red-800"
                                    href="#">
                                    <x-icons.trash class="h-5 w-5" />
                                    <span>{{ __('Delete Comment') }}</span>
                                </x-dropdown-link>
                            @endif
                        </x-slot>
                    </x-dropdown>

                    <x-minimal-button
                        class="pt-1/2 pb-1/2 relative h-7 rounded-full border bg-gray-100 px-3 transition duration-150 ease-in hover:bg-gray-200">
                        <x-icons.comment class="h-6 w-6" />
                    </x-minimal-button>
                </div>
            </div>
        </div>
    </div>
</div>
