<ul {{ $attributes }}>
    @foreach ($topics as $topic)
        <li>
            <a href="{{ route('topic', ['topic' => $topic]) }}"
                class="dark:hover:bg-gray-800 dark:hover:text-blue-700 dark:bg-gray-800 group flex items-center rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/10">
                <img class="mr-3 h-6 w-6" src="{{ asset($topic->image) }}" alt="" />

                <span>{{ $topic->title }}</span>
            </a>
        </li>
    @endforeach
</ul>
