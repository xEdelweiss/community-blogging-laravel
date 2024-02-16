<?php

namespace App\Services;

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
        $tag = $request->tag ? Tag::find($request->tag) : null;
        $topic = $request->topic ? Topic::find($request->topic) : null;

        return new self($tag, $topic);
    }
}
