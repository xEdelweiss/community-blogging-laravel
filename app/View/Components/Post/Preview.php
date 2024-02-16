<?php

namespace App\View\Components\Post;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Preview extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Post $post,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post.preview');
    }

    public function link(): string
    {
        return route('post.show', [
            'post' => $this->post,
            'slug' => $this->post->slug ?? 'none',
        ]);
    }
}
