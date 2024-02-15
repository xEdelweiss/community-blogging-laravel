<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeController extends Controller
{
    public function latest(?Topic $topic = null)
    {
        $tag = $this->getTag();

        return view('home.show', [
            'title' => $this->getTitle(trans('Latest posts'), $topic, $tag),
            'topic' => $topic,
            'tag' => $tag,
            'posts' => $this->getPosts($topic, $tag)
                ->latest()
                ->cursorPaginate(10),
            'likedPosts' => $this->getLikedPosts(),
        ]);
    }

    public function relevant(?Topic $topic = null)
    {
        $tag = $this->getTag();

        return view('home.show', [
            'title' => $this->getTitle(trans('Relevant posts'), $topic, $tag),
            'topic' => $topic,
            'tag' => $tag,
            'posts' => $this->getPosts($topic, $tag)
                ->relevant(auth()->user())
                ->cursorPaginate(10),
            'likedPosts' => $this->getLikedPosts(),
        ]);

    }

    public function top(?Topic $topic = null)
    {
        $tag = $this->getTag();

        return view('home.show', [
            'title' => $this->getTitle('Top posts', $topic, $tag),
            'topic' => $topic,
            'tag' => $tag,
            'posts' => $this->getPosts($topic, $tag)
                ->mostLiked('1 month')
                ->cursorPaginate(10),
            'likedPosts' => $this->getLikedPosts(),
        ]);
    }

    private function getPosts(?Topic $topic, ?Tag $tag): Builder|HasMany|BelongsToMany
    {
        $owner = $topic?->posts() ?? $tag?->posts() ?? Post::query();

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

    private function getTitle(string $section, ?Topic $topic, ?Tag $tag): string
    {
        if ($tag) {
            $tagName = $tag->name;
            return "#{$tagName} - {$section}";
        }

        if ($topic) {
            $topicName = $topic->title;
            return "{$topicName} - {$section}";
        }

        return $section;
    }

    private function getTag(): ?Tag
    {
        return request('tag') ? Tag::whereSlug(request('tag'))->first() : null;
    }
}
