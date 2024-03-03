<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Services\LikeService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private readonly LikeService $likeService,
    )
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create', [
            'post' => new Post(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->validated('title'),
            'url' => $request->validated('url'),
            'intro' => $request->validated('intro'),
            'content' => $request->validated('content'),
            'author_id' => $request->user()->id,
            'topic_id' => $request->validated('topic_id'),
            'published_at' => now(),
        ]);

        $post->syncTags($request->validated('tags', []));

        return redirect()->route('post.show', [
            'post' => $post,
            'slug' => $post->slug ?? 'none',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $userLike = $this->likeService
            ->getUserLikes(auth()->user(), Post::class, $post->id)
            ->first();

        $likesScore = $this->likeService
            ->getLikesScore(Post::class, $post->id)
            ->first(default: 0);

        return view('post.show', [
            'post' => $post,
            'userLike' => $userLike,
            'likesScore' => $likesScore,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.create', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->validated('title'),
            'url' => $request->validated('url'),
            'intro' => $request->validated('intro'),
            'content' => $request->validated('content'),
            'topic_id' => $request->validated('topic_id'),
        ]);

        $post->syncTags($request->validated('tags', []));

        return redirect()->route('post.show', [
            'post' => $post,
            'slug' => $post->slug ?? 'none',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
