<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use JeroenG\Explorer\Domain\Syntax\Matching;
use JeroenG\Explorer\Domain\Syntax\Term;

class SearchController extends Controller
{
    public function posts(Request $request)
    {
        return Post::search($request->query('q'))
            ->filter(new Term('published', true))
            ->take(10)
            ->get();
    }
}
