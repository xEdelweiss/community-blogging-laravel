<?php

namespace App\Services\PostService;

use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Request;

readonly class PostCriteria
{
    public function __construct(
        public ?Tag   $tag = null,
        public ?Topic $topic = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $tag = $request->tag ? Tag::whereSlug($request->tag)->first() : null;
        $topic = $request->topic ? Topic::whereSlug($request->topic)->first() : null;

        return new self($tag, $topic);
    }
}
