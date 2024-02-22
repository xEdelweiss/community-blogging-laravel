<?php

namespace App\Policies;

use App\Models\Like;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LikePolicy
{
    public function create(User $user): bool
    {
        return $user->isVerified();
    }

    public function delete(User $user, Like $like): bool
    {
        return $user->id === $like->user_id;
    }
}
