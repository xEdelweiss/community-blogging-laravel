<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Embed\Embed;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

class EmbedController extends Controller
{
    // @fixme auth + rate limit
    public function show(Request $request, Embed $embed)
    {
        $url = $request->validate(['url' => 'required|url'])['url'];
        $info = $embed->get($url);

        return response()->json([
            'title' => $info->title ?? '',
            'html' => view('embed.link', [
                'title' => $info->title ?? '',
                'description' => $info->description ?? '',
                'image_url' => $info->image ?? '',
                'provider' => $info->providerName ?? '',
                'icon_url' => $info->favicon ?? '',
                'published_at' => $info->publishedTime ? Carbon::createFromTimestamp($info->publishedTime->getTimestamp())->diffForHumans() : null,
            ])->render(),
        ]);
    }
}
