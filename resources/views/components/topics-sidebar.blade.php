<ul {{ $attributes }}>
    @foreach ($topics as $topic)
        <li>
            <a href="{{ route('topic.show', ['topic' => $topic]) }}"
                class="group flex items-center rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/10 dark:bg-gray-800 dark:hover:bg-gray-800 dark:hover:text-blue-700">
                <img class="mr-3 h-6 w-6" src="{{ asset($topic->image) }}" alt="" />

                <span>{{ $topic->title }}</span>
            </a>
        </li>
    @endforeach

    {{-- suggest new topic --}}
    <li>
        <a href="{{ route('topic.create') }}"
            class="group flex items-center rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/10 dark:bg-gray-800 dark:hover:bg-gray-800 dark:hover:text-blue-700">
            <svg class="mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>

            <span>{{ __('Suggest new topic') }}</span>
        </a>
    </li>
</ul>
