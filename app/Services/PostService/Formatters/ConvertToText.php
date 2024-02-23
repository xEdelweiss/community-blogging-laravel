<?php

namespace App\Services\PostService\Formatters;

use App\Services\PostService\PostService;
use Closure;

class ConvertToText
{
    public function __construct(
        private PostService $postService,
    ) {}

    public function __invoke(array $content, Closure $next): string
    {
        return $this->postService->contentToText($content);
    }
}
