<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ViewsCountIndicator extends Component
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
        return view('components.views-count-indicator');
    }

    public function viewsCount(): int
    {
        return $this->post->views;
    }
}
