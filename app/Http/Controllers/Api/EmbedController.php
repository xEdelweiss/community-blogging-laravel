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
    public function fetchMeta(Request $request)
    {
        $embed = new Embed();
        // $meta = get_meta_tags($request->url, true);
        $info = $embed->get($request->url);

        return response()->json([
            'title' => $info->title ?? '',
            'description' => $info->description ?? '',
            'image_url' => $info->image ?? '',
            'provider' => $info->providerName ?? '',
            'icon_url' => $info->favicon ?? '',
            'published_at' => $info->publishedTime ? $info->publishedTime->getTimestamp() : null,

            // 'raw' => $meta,
        ]);
    }
}
