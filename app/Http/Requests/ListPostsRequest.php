<?php

namespace App\Http\Requests;

use App\Enums\MinLikesScore;
use App\Enums\Period;
use App\Enums\Post\ListingOrder;
use App\Models\Tag;
use App\Models\Topic;
use App\Services\PostService\PostCriteria;
use Illuminate\Foundation\Http\FormRequest;

class ListPostsRequest extends FormRequest
{
    private ?PostCriteria $resolved = null;

    public function getCriteria(): PostCriteria
    {
        if (!$this->resolved) {
            $this->resolved = $this->makeCriteria();
        }

        return $this->resolved;
    }

    public function getOrder(): ListingOrder
    {
        return match ($this->segment(1)) {
            'top' => ListingOrder::MostLiked,
            'relevant' => ListingOrder::Relevant,
            default => ListingOrder::Latest,
        };
    }

    private function makeCriteria(): PostCriteria
    {
        $tag = $this->tag ? Tag::whereSlug($this->tag)->first() : null;
        $topic = $this->topic ? Topic::whereSlug($this->topic)->first() : null;
        $period = $this->period ? Period::from($this->period) : Period::All;

        $minScore = $this->score ? MinLikesScore::from($this->score) : MinLikesScore::None;

        if ($this->getOrder()->isMostLiked()) {
            $minScore = MinLikesScore::Positive;
        }

        return new PostCriteria($tag, $topic, $period, $minScore);
    }
}
