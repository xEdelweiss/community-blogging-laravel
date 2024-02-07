<?php

namespace App\View\Components;

use App\Models\Topic;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopicIcon extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Topic $topic,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.topic-icon');
    }

    public function link(): string
    {
        return route('topic.show', [
            'topic' => $this->topic,
        ]);
    }
}
