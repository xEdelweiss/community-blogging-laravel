<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Services\PostCriteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeController extends Controller
{
    public function latest()
    {
        $criteria = PostCriteria::fromRequest(request());

        return view('home.show', [
            'title' => $this->getTitle(trans('Latest posts'), $criteria),
            'criteria' => $criteria,
            'posts' => $this->getPosts($criteria)
                ->latest()
                ->cursorPaginate(10),
            'likedPosts' => $this->getLikedPosts(),
        ]);
    }

    public function relevant()
    {
        $criteria = PostCriteria::fromRequest(request());

        return view('home.show', [
            'title' => $this->getTitle(trans('Relevant posts'), $criteria),
            'criteria' => $criteria,
            'posts' => $this->getPosts($criteria)
                ->relevant(auth()->user())
                ->cursorPaginate(10),
            'likedPosts' => $this->getLikedPosts(),
        ]);

    }

    public function top()
    {
        $criteria = PostCriteria::fromRequest(request());

        return view('home.show', [
            'title' => $this->getTitle('Top posts', $criteria),
            'criteria' => $criteria,
            'posts' => $this->getPosts($criteria)
                ->mostLiked('1 month')
                ->cursorPaginate(10),
            'likedPosts' => $this->getLikedPosts(),
        ]);
    }

    private function getPosts(PostCriteria $criteria): Builder|HasMany|BelongsToMany
    {
        $owner = $criteria->topic?->posts()
            ?? $criteria->tag?->posts()
            ?? Post::query();

        return $owner->published()->with(['author', 'topic']);
    }

    private function getLikedPosts(): Collection
    {
        return \App\Models\Post::published()
            ->mostLiked()
            ->with(['author', 'topic'])
            ->limit(5)
            ->get();
    }

    private function getTitle(string $section, PostCriteria $criteria): string
    {
        if ($criteria->tag) {
            return "#{$criteria->tag->name} - {$section}";
        }

        if ($criteria->topic) {
            return "{$criteria->topic->title} - {$section}";
        }

        return $section;
    }
}
