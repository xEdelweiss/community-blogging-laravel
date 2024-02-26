<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user,
            'posts' => $user->posts()
                ->published()
                ->latestPublications()
                ->with(['author', 'topic'])
                ->withCount('comments')
                ->cursorPaginate(10),
        ]);
    }
}
