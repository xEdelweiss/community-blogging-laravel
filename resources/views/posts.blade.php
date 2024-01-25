<x-main-layout>
    <header class="mb-4 flex flex-wrap justify-start gap-x-4">
        <a href="#" class="px-3 py-1 hover:text-primary ">{{ __('Relevant') }}</a>
        <a href="#" class="px-3 py-1 hover:text-primary bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">{{ __('Latest') }}</a>
        <a href="#" class="px-3 py-1 hover:text-primary ">{{ __('Top') }}</a>
    </header>

    <div class="flex flex-col gap-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 gap-3 flex flex-col hover:shadow-post transition duration-150 ease-in cursor-pointer">
            <div class="flex flex-col gap-1 pe-1">
                <div class="flex justify-between items-start flex-nowrap">
                    <div class="flex flex-col">
                        {{-- <div class="text-xl font-semibold">
                            Lorem ipsum dolor sit amet.
                        </div> --}}
    
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                                <div class="font-bold text-gray-900 hover:text-primary">
                                    <a href="#">John Doe</a>
                                </div>
                                <div>&bull;</div>
                                <div>10 hours ago</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-sm flex items-center gap-3">
                        <a href="#" title="{{ __('Military') }}">
                            <img class="w-6 h-6" src="{{ asset('img/category/military.png') }}">
                        </a>
                    </div>
                </div>
            </div>

            <div class="mx-auto relative">
                <div class="absolute top-0 bottom-0 left-0 right-0">
                    {{-- screen to prevent click on embed --}}
                </div>
                <blockquote class="twitter-tweet"><p lang="uk" dir="ltr">російські окупанти заслуговують тільки на смерть. <br><br>Цю смерть їм доставляють ваші дрони під керуванням воїнів підрозділу Крила до пекла 103 ОБрТРО. <a href="https://t.co/XQMdHwIWE7">pic.twitter.com/XQMdHwIWE7</a></p>&mdash; Serhii Sternenko ✙ (@sternenko) <a href="https://twitter.com/sternenko/status/1749846832002257273?ref_src=twsrc%5Etfw">January 23, 2024</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            
            {{-- <div class="text-gray-900 dark:text-gray-100 line-clamp-3">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos tenetur assumenda possimus veniam tempora eveniet natus sint, similique ut. Eos, nulla! Aut, veritatis rerum? Autem non dolorem dolore laborum vero molestiae quia ab quam consequatur porro illum vitae, quos dolorum perspiciatis sequi repellat reiciendis blanditiis praesentium nisi, illo corrupti asperiores sint ut. Officia nobis blanditiis deleniti earum voluptates voluptas incidunt voluptate harum dolorum impedit? Velit, nesciunt minima. Est, suscipit omnis? Recusandae culpa maxime reprehenderit, deleniti minima harum, perferendis alias excepturi non ducimus omnis perspiciatis ea at sunt ratione tempore repellendus cupiditate fugit dicta officia, quaerat aspernatur dolore eum atque. Aperiam.
            </div> --}}

            <div class="flex items-center justify-between pe-1 mt-1">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400 gap-4">
                    <div class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        <span>2</span>
                    </div>

                    <a href="{{ route('post') }}" class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>

                        <span>12</span>
                    </a>
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

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 gap-3 flex flex-col hover:shadow-post transition duration-150 ease-in cursor-pointer">
            <div class="flex flex-col gap-1 pe-1">
                <div class="flex justify-between flex-nowrap">
                    <div class="text-xl font-semibold">
                        Lorem ipsum dolor sit amet.
                    </div>

                    <div class="text-sm flex items-center gap-3">
                        <a href="#" title="{{ __('Games') }}">
                            <img class="w-6 h-6" src="{{ asset('img/category/games.png') }}">
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="font-bold text-gray-900 hover:text-primary">
                            <a href="#">John Doe</a>
                        </div>
                        <div>&bull;</div>
                        <div>10 hours ago</div>
                    </div>
                </div>
            </div>

            <img class="rounded-xl" src="https://source.unsplash.com/700x400?game&crop&v=2" />
            
            <div class="text-gray-900 dark:text-gray-100 line-clamp-3">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos tenetur assumenda possimus veniam tempora eveniet natus sint, similique ut. Eos, nulla! Aut, veritatis rerum? Autem non dolorem dolore laborum vero molestiae quia ab quam consequatur porro illum vitae, quos dolorum perspiciatis sequi repellat reiciendis blanditiis praesentium nisi, illo corrupti asperiores sint ut. Officia nobis blanditiis deleniti earum voluptates voluptas incidunt voluptate harum dolorum impedit? Velit, nesciunt minima. Est, suscipit omnis? Recusandae culpa maxime reprehenderit, deleniti minima harum, perferendis alias excepturi non ducimus omnis perspiciatis ea at sunt ratione tempore repellendus cupiditate fugit dicta officia, quaerat aspernatur dolore eum atque. Aperiam.
            </div>

            <div class="flex items-center justify-between pe-1 mt-1">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400 gap-4">
                    <div class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        <span>2</span>
                    </div>

                    <a href="{{ route('post') }}" class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>

                        <span>12</span>
                    </a>
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

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 gap-3 flex flex-col hover:shadow-post transition duration-150 ease-in cursor-pointer">
            <div class="flex flex-col gap-1 pe-1">
                <div class="flex justify-between flex-nowrap">
                    <div class="text-xl font-semibold">
                        Lorem ipsum dolor sit amet.
                    </div>

                    <div class="text-sm flex items-center gap-3">
                        <a href="#" title="{{ __('Literature') }}">
                            <img class="w-6 h-6" src="{{ asset('img/category/literature.png') }}">
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="font-bold text-gray-900 hover:text-primary">
                            <a href="#">John Doe</a>
                        </div>
                        <div>&bull;</div>
                        <div>10 hours ago</div>
                    </div>
                </div>
            </div>

            <img class="rounded-xl" src="https://source.unsplash.com/700x400?book&crop&v=3" />
            
            <div class="text-gray-900 dark:text-gray-100 line-clamp-3">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos tenetur assumenda possimus veniam tempora eveniet natus sint, similique ut. Eos, nulla! Aut, veritatis rerum? Autem non dolorem dolore laborum vero molestiae quia ab quam consequatur porro illum vitae, quos dolorum perspiciatis sequi repellat reiciendis blanditiis praesentium nisi, illo corrupti asperiores sint ut. Officia nobis blanditiis deleniti earum voluptates voluptas incidunt voluptate harum dolorum impedit? Velit, nesciunt minima. Est, suscipit omnis? Recusandae culpa maxime reprehenderit, deleniti minima harum, perferendis alias excepturi non ducimus omnis perspiciatis ea at sunt ratione tempore repellendus cupiditate fugit dicta officia, quaerat aspernatur dolore eum atque. Aperiam.
            </div>

            <div class="flex items-center justify-between pe-1 mt-1">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400 gap-4">
                    <div class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        <span>2</span>
                    </div>

                    <a href="{{ route('post') }}" class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>

                        <span>12</span>
                    </a>
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

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 gap-3 flex flex-col hover:shadow-post transition duration-150 ease-in cursor-pointer">
            <div class="flex flex-col gap-1 pe-1">
                <div class="flex justify-between flex-nowrap">
                    <div class="text-xl font-semibold">
                        Lorem ipsum dolor sit amet.
                    </div>

                    <div class="text-sm flex items-center gap-3">
                        <a href="#" title="{{ __('Games') }}">
                            <img class="w-6 h-6" src="{{ asset('img/category/games.png') }}">
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="font-bold text-gray-900 hover:text-primary">
                            <a href="#">John Doe</a>
                        </div>
                        <div>&bull;</div>
                        <div>10 hours ago</div>
                    </div>
                </div>
            </div>

            <img class="rounded-xl" src="https://source.unsplash.com/700x400?crop&v=4" />
            
            <div class="text-gray-900 dark:text-gray-100 line-clamp-3">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos tenetur assumenda possimus veniam tempora eveniet natus sint, similique ut. Eos, nulla! Aut, veritatis rerum? Autem non dolorem dolore laborum vero molestiae quia ab quam consequatur porro illum vitae, quos dolorum perspiciatis sequi repellat reiciendis blanditiis praesentium nisi, illo corrupti asperiores sint ut. Officia nobis blanditiis deleniti earum voluptates voluptas incidunt voluptate harum dolorum impedit? Velit, nesciunt minima. Est, suscipit omnis? Recusandae culpa maxime reprehenderit, deleniti minima harum, perferendis alias excepturi non ducimus omnis perspiciatis ea at sunt ratione tempore repellendus cupiditate fugit dicta officia, quaerat aspernatur dolore eum atque. Aperiam.
            </div>

            <div class="flex items-center justify-between pe-1 mt-1">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400 gap-4">
                    <div class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        <span>2</span>
                    </div>

                    <a href="{{ route('post') }}" class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>

                        <span>12</span>
                    </a>
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

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 gap-3 flex flex-col hover:shadow-post transition duration-150 ease-in cursor-pointer">
            <div class="flex flex-col gap-1 pe-1">
                <div class="flex justify-between flex-nowrap">
                    <div class="text-xl font-semibold">
                        Lorem ipsum dolor sit amet.
                    </div>

                    <div class="text-sm flex items-center gap-3">
                        <a href="#" title="{{ __('Games') }}">
                            <img class="w-6 h-6" src="{{ asset('img/category/games.png') }}">
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="font-bold text-gray-900 hover:text-primary">
                            <a href="#">John Doe</a>
                        </div>
                        <div>&bull;</div>
                        <div>10 hours ago</div>
                    </div>
                </div>
            </div>

            <img class="rounded-xl" src="https://source.unsplash.com/700x400?crop&v=5" />
            
            <div class="text-gray-900 dark:text-gray-100 line-clamp-3">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos tenetur assumenda possimus veniam tempora eveniet natus sint, similique ut. Eos, nulla! Aut, veritatis rerum? Autem non dolorem dolore laborum vero molestiae quia ab quam consequatur porro illum vitae, quos dolorum perspiciatis sequi repellat reiciendis blanditiis praesentium nisi, illo corrupti asperiores sint ut. Officia nobis blanditiis deleniti earum voluptates voluptas incidunt voluptate harum dolorum impedit? Velit, nesciunt minima. Est, suscipit omnis? Recusandae culpa maxime reprehenderit, deleniti minima harum, perferendis alias excepturi non ducimus omnis perspiciatis ea at sunt ratione tempore repellendus cupiditate fugit dicta officia, quaerat aspernatur dolore eum atque. Aperiam.
            </div>

            <div class="flex items-center justify-between pe-1 mt-1">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400 gap-4">
                    <div class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        <span>2</span>
                    </div>

                    <a href="{{ route('post') }}" class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>

                        <span>12</span>
                    </a>
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

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 gap-3 flex flex-col hover:shadow-post transition duration-150 ease-in cursor-pointer">
            <div class="flex flex-col gap-1 pe-1">
                <div class="flex justify-between flex-nowrap">
                    <div class="text-xl font-semibold">
                        Lorem ipsum dolor sit amet.
                    </div>

                    <div class="text-sm flex items-center gap-3">
                        <a href="#" title="{{ __('Games') }}">
                            <img class="w-6 h-6" src="{{ asset('img/category/games.png') }}">
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="font-bold text-gray-900 hover:text-primary">
                            <a href="#">John Doe</a>
                        </div>
                        <div>&bull;</div>
                        <div>10 hours ago</div>
                    </div>
                </div>
            </div>

            <img class="rounded-xl" src="https://source.unsplash.com/700x400?crop&v=6" />
            
            <div class="text-gray-900 dark:text-gray-100 line-clamp-3">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos tenetur assumenda possimus veniam tempora eveniet natus sint, similique ut. Eos, nulla! Aut, veritatis rerum? Autem non dolorem dolore laborum vero molestiae quia ab quam consequatur porro illum vitae, quos dolorum perspiciatis sequi repellat reiciendis blanditiis praesentium nisi, illo corrupti asperiores sint ut. Officia nobis blanditiis deleniti earum voluptates voluptas incidunt voluptate harum dolorum impedit? Velit, nesciunt minima. Est, suscipit omnis? Recusandae culpa maxime reprehenderit, deleniti minima harum, perferendis alias excepturi non ducimus omnis perspiciatis ea at sunt ratione tempore repellendus cupiditate fugit dicta officia, quaerat aspernatur dolore eum atque. Aperiam.
            </div>

            <div class="flex items-center justify-between pe-1 mt-1">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400 gap-4">
                    <div class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        <span>2</span>
                    </div>

                    <a href="{{ route('post') }}" class="text-sm hover:text-black cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>

                        <span>12</span>
                    </a>
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
    </div>
</x-main-layout>
