<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public User $user,
        public bool $withLink = false,
        public string $linkClass = '',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.avatar');
    }

    public function link(): string
    {
        return route('user.show', [
            'user' => $this->user,
        ]);
    }

    public function avatarUrl(): string
    {
        return asset($this->user->avatar);
    }
}
