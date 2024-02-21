<?php

namespace App\Services\PostService;

use App\Services\PostService\Editor\PostEditor;

class PostService
{
    public function __construct(
        private readonly PostEditor $editor = new PostEditor(),
    ) {}

    public function contentToText(array $content): string
    {
        return $this->editor
            ->setContent($content)
            ->getText();
    }
}
