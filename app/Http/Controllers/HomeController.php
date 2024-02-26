<?php

namespace App\Http\Controllers;

use App\Enums\Post\ListingOrder;
use App\Http\Requests\ListPostsRequest;
use App\Models\Post;
use App\Services\LikeService;
use App\Services\PostService\ListingService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function __construct(
        private readonly ListingService $listingService,
        private readonly LikeService $likeService,
    ) {}

    public function posts(ListPostsRequest $request)
    {
        if (app()->environment('local')) {
            \Debugbar::debug($request->getCriteria());
            \Debugbar::debug($request->getOrder());
        }

        $posts = $this->listingService
            ->getPaginatedListing(
                $request->getCriteria(),
                $request->getOrder(),
                $request->user(),
            );

        if ($posts->currentPage() > $posts->lastPage()) {
            return redirect($posts->url($posts->lastPage()));
        }

        return view('home.show', [
            'title' => $this->getPageTitle($request),

            'criteria' => $request->getCriteria(),

            'posts' => $posts,
            'likesByPost' => $this->getUserLikes($posts),
            'likesScoresByPost' => $this->getLikesScore($posts),
        ]);
    }

    private function getUserLikes(LengthAwarePaginator $posts): Collection
    {
        return $this->likeService
            ->getUserLikes(auth()->user(), Post::class, $posts->pluck('id'));
    }

    private function getLikesScore(LengthAwarePaginator $posts): Collection
    {
        return $this->likeService
            ->getLikesScore(Post::class, $posts->pluck('id'));
    }

    private function getPageTitle(ListPostsRequest $request): string
    {
        $order = $request->getOrder();
        $criteria = $request->getCriteria();

        $section = match ($order) {
            ListingOrder::Latest => trans('Latest posts'),
            ListingOrder::MostLiked => trans('Top posts'),
            ListingOrder::Relevant => trans('Relevant posts'),
        };

        if ($criteria->tag) {
            return "#{$criteria->tag->name} - {$section}";
        }

        if ($criteria->topic) {
            return "{$criteria->topic->title} - {$section}";
        }

        return $section;
    }
}
