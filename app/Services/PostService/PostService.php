<?php

namespace App\Services\PostService;

use App\Services\PostService\Editor\PostEditor;

class PostService
{
    public function __construct(
        private readonly PostEditor $editor,
    ) {}

    public function contentToText(array|null $content): string
    {
        if (empty($content)) {
            return '';
        }

        return $this->editor
            ->setContent($content)
            ->getText();
    }

    public function contentToHtml(array|null $content): string
    {
        if (empty($content)) {
            return '';
        }

        return $this->editor
            ->setContent($content)
            ->getHTML();
    }
}
