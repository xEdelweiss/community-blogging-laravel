<?php

namespace App\Services\PostService;

use App\Enums\Period;
use App\Enums\MinLikesScore;
use App\Models\Tag;
use App\Models\Topic;

readonly class PostCriteria
{
    public function __construct(
        public ?Tag          $tag = null,
        public ?Topic        $topic = null,
        public Period        $period = Period::All,
        public MinLikesScore $minScore = MinLikesScore::None,
    ) {}
}
