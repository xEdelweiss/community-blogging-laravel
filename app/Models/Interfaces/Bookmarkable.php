<?php

namespace App\Models\Interfaces;

use App\Models\User;

interface Bookmarkable
{
    public function isBookmarkedBy(User $user): bool;
    public function addBookmark(User $user): void;
    public function removeBookmark(User $user): void;
    public function refreshBookmarksCount(): void;
}
