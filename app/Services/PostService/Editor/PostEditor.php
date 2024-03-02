<?php

namespace App\Services\PostService\Editor;

use Tiptap\Editor;

class PostEditor extends Editor
{
    #[\Override]
    public function getText($configuration = []): string
    {
        return (new TextSerializer($this->schema, $configuration))->process($this->document);
    }
}
