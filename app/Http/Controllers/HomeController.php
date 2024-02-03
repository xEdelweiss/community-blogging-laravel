<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function latest()
    {
        return view('home', [
            'posts' => \App\Models\Post::published()
                ->newest()
                ->with(['author', 'topic'])
                ->cursorPaginate(10),
            'likedPosts' => \App\Models\Post::published()
                ->inRandomOrder()
                ->with(['author', 'topic'])
                ->limit(5)
                ->get(),
            'trendingPosts' => \App\Models\Post::published()
                ->inRandomOrder()
                ->with(['author', 'topic'])
                ->limit(5)
                ->get(),
        ]);
    }
}
