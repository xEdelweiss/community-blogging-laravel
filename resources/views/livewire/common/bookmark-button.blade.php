<?php

use Livewire\Volt\Component;
use App\Enums\Rate;
use App\Models\Like;
use App\Models\Interfaces\Bookmarkable;

new class extends Component {
    public Bookmarkable $bookmarkable;
    public ?\App\Models\User $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = auth()->check() ? auth()->user() : null;
    }

    public function toggle(): void
    {
        if (!$this->user) {
            $this->redirect(route('login'));
            return;
        }

        if ($this->bookmarkable->isBookmarkedBy($this->user)) {
            $this->bookmarkable->removeBookmark($this->user);
        } else {
            $this->bookmarkable->addBookmark($this->user);
        }

        $this->bookmarkable->refreshBookmarksCount();
    }

    public function isBookmarked(): bool
    {
        if (!$this->user) {
            return false;
        }

        return $this->bookmarkable->isBookmarkedBy($this->user);
    }
}; ?>

<div class="group flex cursor-pointer items-center gap-x-1 hover:text-black"
    wire:click.stop="toggle">

    <x-icons.bookmark
        class="{{ $this->isBookmarked() ? '[&>path]:fill-primary/75 [&>path]:stroke-primary-dark/75 group-hover:[&>path]:fill-primary group-hover:[&>path]:stroke-primary-dark' : '' }} h-5 w-5" />

    <span
        class="{{ $this->isBookmarked() ? 'font-semibold text-black/75 group-hover:text-black' : '' }}">{{ $bookmarkable->bookmarks_count }}</span>
</div>
