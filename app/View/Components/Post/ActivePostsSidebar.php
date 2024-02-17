<?php

namespace App\View\Components\Post;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ActivePostsSidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private string $interval = '3 days',
        private int $count = 5,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post.active-posts-sidebar', [
            'posts' => $this->getActivePosts(),
        ]);
    }

    /** @return Collection<Post> */
    private function getActivePosts(): Collection
    {
        return Post::published()
            ->mostCommented($this->interval)
            ->orderByDesc('comments_count')
            ->limit($this->count)
            ->get();
    }
}
