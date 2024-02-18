<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EmbedService\EmbedDto;
use Embed\Embed;
use Illuminate\Http\Request;

class EmbedController extends Controller
{
    public function __construct(
        private Embed $embed
    ) {}

    // @fixme auth + rate limit
    public function show(Request $request)
    {
        $url = $request->validate(['url' => 'required|url'])['url'];
        $meta = $this->fetchMeta($url);

        $result = [
            'title' => $meta->title ?? '',
            'html' => view('embed.link', ['meta' => $meta])->render(),
        ];

        return response()->json($result);
    }

    private function fetchMeta(string $url): EmbedDto
    {
        $version = EmbedDto::VERSION;

        return cache()->store('redis')->remember("embed-{$version}-{$url}", 60 * 60 * 24, function () use ($url) {
            return EmbedDto::makeFromExtractor($this->embed->get($url));
        });
    }
}
