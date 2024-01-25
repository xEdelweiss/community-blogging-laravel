<div>
    <aside class="hidden flex-none lg:sticky lg:block lg:self-start" style="width: 210px; top: 40px;">
        <div class="lg:sticky lg:text-center">
            <ul>
                @foreach($topics as $topic)
                    <li>
                        <a href="{{ route('topic', ['topic' => $topic]) }}"
                           class="group flex items-center rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/10 dark:hover:bg-gray-800 dark:hover:text-blue-700 dark:bg-gray-800"
                        >
                            <img class="w-6 h-6 mr-3"
                                 src="{{ asset($topic->image) }}"
                                 alt=""
                            />

                            <span>{{ $topic->title }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
