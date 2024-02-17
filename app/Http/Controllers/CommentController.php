<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $post = Post::find($request->post_id);

        $comment = Comment::make([
            'content' => $request->comment,
            'parent_id' => $request->parent_id,
            'author_id' => $request->user()->id,
        ]);

        $post->comments()->save($comment);

        return redirect()->route('post.show', [
            'post' => $post,
            'slug' => $post->slug ?? 'none',
            '#comment-' . $comment->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
