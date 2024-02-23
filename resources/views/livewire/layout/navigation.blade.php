<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\Post;
use JeroenG\Explorer\Domain\Syntax\Term;

new class extends Component {
    public string $search = '';
    public array $results = [];

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function updatedSearch(): void
    {
        if (strlen($this->search) < 3) {
            $this->results = [];

            return;
        }

        $this->results = Post::search($this->search)
            ->filter(new Term('published', true))
            ->take(10)
            ->get()
            ->map(function (Post $post) {
                return array_merge($post->toArray(), [
                    'url' => route('post.show', [
                        'post' => $post->id,
                        'slug' => $post->slug,
                    ]),
                ]);
            })
            ->toArray();
    }
}; ?>
<nav
    class="w-full border-b border-gray-100 bg-gray-100 px-2 pe-4 dark:border-gray-700 dark:bg-gray-900 sm:px-8">

    <div class="mx-auto" style="max-width: 1400px;">
        <div class="flex h-20 items-center justify-between">
            <div class="flex items-center">
                <!-- Hamburger -->
                <div class="flex items-center sm:hidden">
                    <button wire:click="$dispatch('left-sidebar-open')"
                        class="me-1 inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
                        <x-icons.burger class="h-6 w-6" />
                    </button>
                </div>

                <a href="{{ route('home') }}" wire:navigate>
                    <x-application-logo
                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <div
                class="relative me-2 ms-3 flex hidden w-full items-center sm:flex sm:w-1/3">
                <x-search-box class="w-full" />

                @if ($results)
                    <div
                        class="absolute top-0 z-20 mt-12 w-full rounded-lg bg-white shadow-lg">
                        <ul>
                            @forelse ($results as $result)
                                <li>
                                    <a href="{{ $result['url'] }}"
                                        class="block px-4 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-800">
                                        {{ $result['title'] }}
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <div
                                        class="block px-4 py-2 text-gray-900 dark:text-white">
                                        {{ __('No results found…') }}</div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                @endif
            </div>

            <div class="flex shrink-0 items-center gap-3 sm:ms-6">
                <a href="{{ route('post.create') }}">
                    <x-secondary-button class="gap-x-2">
                        <x-icons.pen class="h-4 w-4" />
                        <span
                            class="hidden sm:inline">{{ __('Write post') }}</span>
                    </x-secondary-button>
                </a>

                <x-user-avatar-menu />
            </div>
        </div>
    </div>
</nav>
