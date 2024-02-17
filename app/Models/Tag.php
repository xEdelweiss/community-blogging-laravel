<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /** @return Collection<Tag> */
    public static function findOrCreateAll(array $tagNames): Collection
    {
        $existingTags = self::whereIn('name', $tagNames)->get();

        $newTags = collect($tagNames)
            ->diff($existingTags->pluck('name'))
            ->map(fn($name) => self::create(['name' => $name, 'slug' => Str::slug($name)]));

        return $existingTags->merge($newTags);
    }
}
