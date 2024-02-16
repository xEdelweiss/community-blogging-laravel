<div>
    <div class="comments-container relative my-8 ml-22 mt-2 space-y-6 pt-4">
        <div class="comment-container relative mt-4 flex rounded-xl bg-white">
            <div class="flex flex-1 px-5 py-6">
                <div class="flex-none">
                    <x-avatar :user="\App\Models\User::inRandomOrder()->first()" class="h-14 w-14" with-link />
                </div>
                <div class="mx-4 flex w-full flex-col justify-between">
                    <div class="flex-1 text-gray-600">
                        Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                        Corporis, cum non. Aliquam eaque ex perspiciatis. Dolor
                        explicabo, fugiat id neque
                        perferendis possimus provident quis tempore! Amet
                        assumenda deserunt dolores dolorum
                        impedit, maiores maxime mollitia odio quibusdam, quo
                        reiciendis rem suscipit temporibus!
                        Dicta et hic iusto, minima praesentium rerum unde
                        voluptatem.
                    </div>

                    <div class="mt-3 flex items-center justify-between">
                        <div
                            class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
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
        </div> {{-- end comment-container --}}

        <div
            class="is-admin comment-container relative mt-4 flex rounded-xl bg-white">
            <div class="flex flex-1 px-5 py-6">
                <div class="flex-none">
                    <x-avatar :user="\App\Models\User::inRandomOrder()->first()" class="h-14 w-14" with-link />

                    <div
                        class="text-blue mt-1 text-center text-xxs font-bold uppercase">
                        Admin
                    </div>
                </div>
                <div class="mx-4 flex w-full flex-col justify-between">
                    <h4 class="mb-3 text-xl font-semibold">
                        <a href="#" class="hover:underline">Title changed to "Updated title"</a>
                    </h4>

                    <div class="flex-1 text-gray-600">
                        Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                        Corporis, cum non. Aliquam eaque ex perspiciatis. Dolor
                        explicabo, fugiat id neque
                        perferendis possimus provident quis tempore! Amet
                        assumenda deserunt dolores dolorum
                        impedit, maiores maxime mollitia odio quibusdam, quo
                        reiciendis rem suscipit temporibus!
                        Dicta et hic iusto, minima praesentium rerum unde
                        voluptatem.
                    </div>

                    <div class="mt-3 flex items-center justify-between">
                        <div
                            class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="text-blue font-bold">Andrea</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
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
        </div> {{-- end comment-container --}}

        <div class="comment-container relative mt-4 flex rounded-xl bg-white">
            <div class="flex flex-1 px-5 py-6">
                <div class="flex-none">
                    <x-avatar :user="\App\Models\User::inRandomOrder()->first()" class="h-14 w-14" with-link />
                </div>
                <div class="mx-4 flex w-full flex-col justify-between">
                    {{-- <h4 class="text-xl font-semibold mb-3">
                        <a href="#" class="hover:underline">A random title</a>
                    </h4> --}}

                    <div class="flex-1 text-gray-600">
                        Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                        Corporis, cum non. Aliquam eaque ex perspiciatis. Dolor
                        explicabo, fugiat id neque
                        perferendis possimus provident quis tempore! Amet
                        assumenda deserunt dolores dolorum
                        impedit, maiores maxime mollitia odio quibusdam, quo
                        reiciendis rem suscipit temporibus!
                        Dicta et hic iusto, minima praesentium rerum unde
                        voluptatem.
                    </div>

                    <div class="mt-3 flex items-center justify-between">
                        <div
                            class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
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
        </div> {{-- end comment-container --}}
    </div>
</div>
