<?php

namespace App\View\Components\Listing;

use App\Enums\Period;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PeriodSelect extends Component
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
        return view('components.listing.period-select', [
            'selected' => request('period', Period::All->value),
            'periods' => [
                Period::Day->value => 'Today',
                Period::Week->value => 'Last week',
                Period::Month->value => 'Last month',
                Period::All->value => 'All time',
            ],
        ]);
    }
}
