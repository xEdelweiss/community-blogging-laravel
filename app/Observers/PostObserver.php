<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\PostService\PostService;

class PostObserver
{
    public function __construct(
        private PostService $postService
    ) {}

    public function saving(Post $post): void
    {
        $content = $post->content ? json_decode($post->content, true) : null;
        $post->html = $this->postService->contentToHtml($content);
    }
}
