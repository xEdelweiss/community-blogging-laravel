<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    public function like(LikeRequest $request): JsonResponse
    {
        $likeable = $request->likeable();

        $request->user()->like($likeable);

        return response()->json([
            'likes' => $likeable->likes()->count(),
        ]);
    }

    public function unlike(LikeRequest $request): JsonResponse
    {
        $likeable = $request->likeable();

        $request->user()->unlike($likeable);

        return response()->json([
            'likes' => $likeable->refresh()->likes()->count(),
        ]);
    }
}
