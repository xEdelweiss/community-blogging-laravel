<?php

namespace App\View\Components;

use App\Models\Topic;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TopicsSidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.topics-sidebar');
    }

    /** @return Collection<Topic> */
    public function topics(): Collection
    {
        return Topic::all();
    }

    public function isSelected(Topic $topic): bool
    {
        return $topic->slug === $this->getSelectedTopicSlug($topic);
    }

    private function getSelectedTopicSlug(): ?string
    {
        $topic = request('topic');

        if ($topic instanceof Topic) {
            return $topic->slug;
        }

        if (is_string($topic)) {
            return $topic;
        }

        return null;
    }
}
