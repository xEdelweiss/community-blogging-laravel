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
        // $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->get('title'),
            'url' => $request->get('url'),
            'intro' => $request->get('intro'),
            'content' => $request->get('content'),
            'author_id' => $request->user()->id,
            'topic_id' => $request->topic_id,
            'published_at' => now(),
        ]);

        $post->syncTags($request->tags);

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
        $this->authorize('view', $post);

        $userLike = $this->likeService
            ->getUserLikes(auth()->user(), Post::class, $post->id)
            ->first();

        $likesScore = $this->likeService
            ->getLikesScore(Post::class, $post->id)
            ->first();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
