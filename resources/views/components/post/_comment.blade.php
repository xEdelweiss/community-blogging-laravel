<div x-data="{ replyOpen: false }" id="comment-{{ $comment->id }}"
    class="comment-container-parent relative flex rounded-l-md bg-white sm:rounded-xl">
    <div class="flex w-full flex-col gap-y-3 px-5 pb-4 pt-6">

        {{-- avatar + comment --}}
        <div class="flex flex-1 gap-x-4">
            <div class="flex-none">
                <x-avatar :user="$comment->author" class="h-14 w-14" with-link />
            </div>
            <div class="flex w-full flex-col justify-between">
                <div class="flex-1 text-gray-600">
                    {{ $comment->content }}
                </div>
            </div>
        </div>

        {{-- footer --}}
        <div class="flex flex-1 sm:gap-x-4">
            <div class="w-0 sm:w-14 sm:flex-none"></div>

            <div class="flex flex-1 items-center justify-between">
                {{-- name + date --}}
                <div
                    class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                    <div class="font-bold text-gray-900">
                        <a href="{{ route('user.show', ['user' => $comment->author]) }}"
                            class="line-clamp-1 hover:text-primary">
                            {{ $comment->author->name }}
                        </a>
                    </div>
                    <div>&bull;</div>
                    <div>
                        <a class="whitespace-nowrap hover:underline"
                            href="{{ route('post.show', ['post' => $post, 'slug' => $post->slug ?? 'none']) }}#comment-{{ $comment->id }}">
                            {{ $comment->created_at->diffForHumans() }}
                        </a>
                    </div>
                </div>

                {{-- buttons --}}
                <div class="flex gap-x-2">
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
                                <span>{{ __('Mark as spam') }}</span>
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

                    @auth()
                        <x-minimal-button
                            @click.prevent="replyOpen = !replyOpen; if (replyOpen) $nextTick(() => $refs.reply.focus());"
                            class="pt-1/2 pb-1/2 relative h-7 rounded-full border bg-gray-100 px-3 transition duration-150 ease-in hover:bg-gray-200">
                            <template x-if="!replyOpen">
                                <x-icons.comment class="h-6 w-6" />
                            </template>
                            <template x-if="replyOpen">
                                <x-icons.cross class="h-6 w-6" />
                            </template>
                        </x-minimal-button>
                    @else
                        <a href="{{ route('login') }}">
                            <x-minimal-button
                                class="pt-1/2 pb-1/2 relative h-7 rounded-full border bg-gray-100 px-3 transition duration-150 ease-in hover:bg-gray-200">
                                <x-icons.comment class="h-6 w-6" />
                            </x-minimal-button>
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        {{-- reply form --}}
        @auth()
            <template x-if="replyOpen">
                <form action="{{ route('comment.store') }}" method="post"
                    class="flex w-full flex-col border-t border-t-gray-100 pt-4">
                    @csrf
                    <input type="hidden" name="post_id"
                        value="{{ $post->id }}" />
                    <input type="hidden" name="parent_id"
                        value="{{ $comment->id }}" />

                    <div class="flex flex-1 gap-x-4">
                        <div class="flex w-full flex-col justify-between">
                            <div class="flex-1 text-gray-600">
                                <x-minimal-textarea no-border x-ref="reply"
                                    name="comment" class="w-full resize-none"
                                    rows="2"
                                    placeholder="{{ __('Reply to this comment...') }}" />
                            </div>
                        </div>

                        <div class="flex-none">
                            <x-avatar :user="auth()->user()" class="h-14 w-14"
                                with-link />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button
                            type="submit">{{ __('Reply') }}</x-primary-button>
                    </div>
                </form>
            </template>
        @endauth
    </div>
</div>
