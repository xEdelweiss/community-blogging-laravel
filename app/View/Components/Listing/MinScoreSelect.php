<?php

namespace App\View\Components\Listing;

use App\Enums\MinLikesScore;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MinScoreSelect extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listing.min-score-select', [
            'selected' => request('score', MinLikesScore::None->value),
            'scores' => [
                MinLikesScore::NonNegative->value => 'Hide downvoted',
                MinLikesScore::None->value => 'Show all',
            ],
        ]);
    }
}
