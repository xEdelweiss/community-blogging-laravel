<?php

namespace App\Models\Traits;

use App\Models\UniqueView;
use App\Models\User;
use App\Services\ViewService\ViewType;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasViews
{
    abstract public function getKey();

    public function incrementViewStat(ViewType $type): void
    {
        $this->increment($type->getModelKey());
    }

    public function uniqueViews(): MorphMany
    {
        return $this->morphMany(UniqueView::class, 'viewable');
    }

    public function addUniqueView(User $user): UniqueView
    {
        return $this->uniqueViews()->firstOrCreate([
            'user_id' => $user->id,
        ]);
    }
}
