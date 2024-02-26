<?php

namespace App\Models;

use App\Enums\Rate;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];

    protected $casts = [
        'liked' => Rate::class,
    ];
}
