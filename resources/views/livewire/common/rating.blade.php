<?php

use Livewire\Volt\Component;
use App\Enums\Rate;
use App\Models\Like;
use App\Models\Post;

new class extends Component {
    private ?\App\Models\User $user;

    public Post $post;
    public ?Like $userLike;
    public int $likeScore;

    public function __construct()
    {
        parent::__construct();
        $this->user = auth()->check() ? auth()->user() : null;
        $this->userLike = new Like();
    }

    public function like(): void
    {
        if (!$this->user) {
            $this->redirect(route('login'));
            return;
        }

        if ($this->userLike?->liked === Rate::Like) {
            $this->userLike = $this->post->unlike($this->user);
        } else {
            $this->userLike = $this->post->like($this->user);
        }

        $this->likeScore = $this->post->likes()->sum('liked');
    }

    public function dislike(): void
    {
        if (!$this->user) {
            $this->redirect(route('login'));
            return;
        }

        if ($this->userLike?->liked === Rate::Dislike) {
            $this->userLike = $this->post->unlike($this->user);
        } else {
            $this->userLike = $this->post->dislike($this->user);
        }

        $this->likeScore = $this->post->likes()->sum('liked');
    }
}; ?>

<div class="z-10 flex flex-row items-center justify-between gap-x-1">
    <x-icons.up wire:click.stop.debounce="like" micro
        class="{{ $this->userLike?->liked === Rate::Like ? 'fill-green-700/70 stroke-green-700/70' : 'stroke-gray-400' }} h-4 w-4 cursor-pointer hover:fill-green-700 hover:stroke-green-700" />

    <span
        class="@if ($likeScore > 0) text-green-700/80 @elseif ($likeScore < 0) text-red-700/80 @endif w-4 text-center font-semibold">{{ $likeScore > 0 ? '+' : '' }}{{ $likeScore }}</span>

    <x-icons.down wire:click.stop.debounce="dislike" micro
        class="{{ $this->userLike?->liked === Rate::Dislike ? 'fill-red-700/70 stroke-red-700/70' : 'stroke-gray-400' }} h-4 w-4 cursor-pointer hover:fill-red-700 hover:stroke-red-700" />
</div>
