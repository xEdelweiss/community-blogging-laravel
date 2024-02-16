<ul {{ $attributes }}>
    @foreach ($topics as $topic)
        <li>
            <a href="{{ route('home', ['topic' => $topic]) }}"
                class="@if (request('topic')?->slug === $topic->slug) bg-primary/10 dark:bg-gray-800 dark:text-blue-700 @endif group flex items-center rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/20 dark:bg-gray-800 dark:hover:bg-gray-800 dark:hover:text-blue-700">
                <img class="mr-3 h-6 w-6" src="{{ asset($topic->image) }}"
                    alt="" />

                <span>{{ $topic->title }}</span>
            </a>
        </li>
    @endforeach

    {{-- suggest new topic --}}
    <li>
        <a href="{{ route('topic.create') }}"
            class="group flex items-center gap-x-3 rounded-lg px-3 py-2 text-left font-medium hover:bg-primary/10 dark:bg-gray-800 dark:hover:bg-gray-800 dark:hover:text-blue-700">
            <x-icons.plus class="h-6 w-6" />
            <span>{{ __('Suggest new topic') }}</span>
        </a>
    </li>
</ul>
