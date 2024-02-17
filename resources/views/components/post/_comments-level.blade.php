@if ($comments->where('parent_id', $parentId)->count() > 0)
    <div class="comments-level">
        @foreach ($comments->where('parent_id', $parentId) as $comment)
            <div class="comment-container">
                <div
                    class="comment-container-parent relative flex rounded-xl bg-white">
                    <div class="flex flex-1 px-5 py-6">
                        <div class="flex-none">
                            <x-avatar :user="$comment->author" class="h-14 w-14"
                                with-link />
                        </div>
                        <div class="mx-4 flex w-full flex-col justify-between">
                            <div class="flex-1 text-gray-600">
                                {{ $comment->content }}
                            </div>

                            <div class="mt-3 flex items-center justify-between">
                                <div
                                    class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                                    <div class="font-bold text-gray-900">
                                        {{ $comment->author->name }}</div>
                                    <div>&bull;</div>
                                    <div>
                                        {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <button
                                        class="pt-1/2 pb-1/2 relative h-7 rounded-full border bg-gray-100 px-3 transition duration-150 ease-in hover:bg-gray-200">
                                        <x-icons.ellipsis
                                            class="h-6 w-6 text-gray-500" />

                                        <ul
                                            class="absolute ml-8 hidden w-44 rounded-xl bg-white py-3 text-left font-semibold shadow-dialog">
                                            <li><a href="#"
                                                    class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                                                    as Spam</a></li>
                                            <li><a href="#"
                                                    class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                                                    Post</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('components.post._comments-level', [
                    'parentId' => $comment->id,
                    'comments' => $post->comments,
                    'level' => $level + 1,
                ])

            </div>
        @endforeach
    </div>
@endif
