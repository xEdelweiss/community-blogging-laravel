<x-main-layout>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 gap-3 flex flex-col">
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center font-semibold space-x-2 text-gray-400">
                <a href="#">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-10 h-10 rounded-xl" />
                </a>

                <div>
                    <div class="text-sm font-bold text-gray-900 hover:text-primary">
                        <a href="#">John Doe</a>
                    </div>
                    <div class="text-xs">Posted on <time datetime="2024-01-24T00:08:52Z" class="date-no-year" title="середа, 24 січня 2024 р. о 02:08:52">Jan 24</time></div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-secondary-button>
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                      
                    <span>Subscribe</span>
                </x-secondary-button>
            </div>
        </div>

        <div>
            <div class="flex justify-between items-baseline">
                <h1 class="text-3xl font-semibold leading-snug line-clamp-2">
                    Lorem ipsum dolor sit amet.
                </h1>

                <div class="text-sm flex items-center gap-3">
                    <a href="#" title="{{ __('Games') }}">
                        <img class="w-6 h-6" src="{{ asset('img/category/games.png') }}">
                    </a>
                </div>
            </div>
            <div class="leading-none text-sm flex gap-2">
                <a href="#" class="hover:text-primary">#lorem</a>
                <a href="#" class="hover:text-primary">#ipsum</a>
                <a href="#" class="hover:text-primary">#dolor</a>
            </div>
        </div>

        <img class="rounded-xl" src="https://source.unsplash.com/700x400?v=1" />
        
        <div class="text-gray-900 dark:text-gray-100">
            <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. At ab voluptas enim aperiam vitae sed recusandae quod? Enim deserunt quas, beatae, amet aliquam perspiciatis modi sapiente asperiores eveniet corrupti tenetur consequuntur nobis repellendus accusantium laboriosam repudiandae quod rerum ut debitis reiciendis reprehenderit odio at. Magni quisquam quae ab modi voluptatem.</p>

            <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo numquam tempora modi assumenda sapiente reiciendis harum quidem nesciunt odio, atque natus autem impedit debitis magnam itaque. Sunt laudantium vitae quisquam.</p>

            <p class="mb-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequuntur explicabo nemo non quos possimus asperiores, nesciunt iste voluptatibus! Assumenda eius ullam commodi, nisi magnam odit ipsam, recusandae officiis corporis quos, adipisci accusamus exercitationem est cupiditate nulla placeat inventore error dolor ipsum quis deleniti corrupti sint?</p>
        </div>

        <div class="flex items-center justify-between pe-1 mt-1">
            <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400 gap-4">
                <div class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>

                    <span>2</span>
                </div>

                <div class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>

                    <span>12</span>
                </div>
            </div>

            <div class="flex items-center text-gray-400 gap-4">
                <div class="text-sm flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <span>17</span>
                </div>

                <div class="hover:text-black cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="comments-container relative space-y-6 ml-22 my-8 pt-4 mt-2">
            <div class="comment-container relative bg-white rounded-xl flex mt-4">
                <div class="flex flex-1 px-5 py-6">
                    <div class="flex-none">
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl" />
                        </a>
                    </div>
                    <div class="w-full mx-4 flex flex-col justify-between">
                        {{--<h4 class="text-xl font-semibold mb-3">
                            <a href="#" class="hover:underline">A random title</a>
                        </h4>--}}

                        <div class="flex-1 text-gray-600">
                            Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, cum non. Aliquam eaque ex perspiciatis. Dolor explicabo, fugiat id neque perferendis possimus provident quis tempore! Amet assumenda deserunt dolores dolorum impedit, maiores maxime mollitia odio quibusdam, quo reiciendis rem suscipit temporibus! Dicta et hic iusto, minima praesentium rerum unde voluptatem.
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                                <div class="font-bold text-gray-900">John Doe</div>
                                <div>&bull;</div>
                                <div>10 hours ago</div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in pt-1/2 pb-1/2 px-3">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>

                                    <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                        <li><a href="#" class="hover:bg-gray-100 px-5 py-3 block transition duration-150 ease-in">Mark as Spam</a></li>
                                        <li><a href="#" class="hover:bg-gray-100 px-5 py-3 block transition duration-150 ease-in">Delete Post</a></li>
                                    </ul>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- end comment-container --}}

            <div class="is-admin comment-container relative bg-white rounded-xl flex mt-4">
                <div class="flex flex-1 px-5 py-6">
                    <div class="flex-none">
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl" />
                        </a>

                        <div class="text-center text-blue text-xxs mt-1 font-bold uppercase">Admin</div>
                    </div>
                    <div class="w-full mx-4 flex flex-col justify-between">
                        <h4 class="text-xl font-semibold mb-3">
                            <a href="#" class="hover:underline">Status changed to "Consideration"</a>
                        </h4>

                        <div class="flex-1 text-gray-600">
                            Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, cum non. Aliquam eaque ex perspiciatis. Dolor explicabo, fugiat id neque perferendis possimus provident quis tempore! Amet assumenda deserunt dolores dolorum impedit, maiores maxime mollitia odio quibusdam, quo reiciendis rem suscipit temporibus! Dicta et hic iusto, minima praesentium rerum unde voluptatem.
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                                <div class="font-bold text-blue">Andrea</div>
                                <div>&bull;</div>
                                <div>10 hours ago</div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in pt-1/2 pb-1/2 px-3">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>

                                    <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                        <li><a href="#" class="hover:bg-gray-100 px-5 py-3 block transition duration-150 ease-in">Mark as Spam</a></li>
                                        <li><a href="#" class="hover:bg-gray-100 px-5 py-3 block transition duration-150 ease-in">Delete Post</a></li>
                                    </ul>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- end comment-container --}}

            <div class="comment-container relative bg-white rounded-xl flex mt-4">
                <div class="flex flex-1 px-5 py-6">
                    <div class="flex-none">
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=4" alt="avatar" class="w-14 h-14 rounded-xl" />
                        </a>
                    </div>
                    <div class="w-full mx-4 flex flex-col justify-between">
                        {{--<h4 class="text-xl font-semibold mb-3">
                            <a href="#" class="hover:underline">A random title</a>
                        </h4>--}}

                        <div class="flex-1 text-gray-600">
                            Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, cum non. Aliquam eaque ex perspiciatis. Dolor explicabo, fugiat id neque perferendis possimus provident quis tempore! Amet assumenda deserunt dolores dolorum impedit, maiores maxime mollitia odio quibusdam, quo reiciendis rem suscipit temporibus! Dicta et hic iusto, minima praesentium rerum unde voluptatem.
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                                <div class="font-bold text-gray-900">John Doe</div>
                                <div>&bull;</div>
                                <div>10 hours ago</div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in pt-1/2 pb-1/2 px-3">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>

                                    <ul class="hidden absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                        <li><a href="#" class="hover:bg-gray-100 px-5 py-3 block transition duration-150 ease-in">Mark as Spam</a></li>
                                        <li><a href="#" class="hover:bg-gray-100 px-5 py-3 block transition duration-150 ease-in">Delete Post</a></li>
                                    </ul>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- end comment-container --}}
        </div>
    </div>
</x-main-layout>
