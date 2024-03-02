<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EmbedService\EmbedMetaDto;
use App\Services\EmbedService\EmbedService;
use Illuminate\Http\Request;

class EmbedController extends Controller
{
    public function __construct(
        readonly private EmbedService $embedService,
    ) {}

    // @fixme auth + rate limit
    public function show(Request $request)
    {
        $url = $request->validate(['url' => 'required|url'])['url'];
        $meta = $this->fetch($url);

        $result = [
            'title' => $meta->title ?? '',
            'html' => $this->renderHtml($meta),
        ];

        return response()->json($result);
    }

    private function fetch(string $url): EmbedMetaDto
    {
        $cacheStore = config('embed.cache.store');
        $ttl = config('embed.cache.ttl');
        $version = $this->embedService->getVersion();
        $key = "embed-{$version}-{$url}";

        return cache()->store($cacheStore)->remember($key, $ttl,
            fn() => $this->embedService->get($url)
        );
    }

    private function renderHtml(EmbedMetaDto $meta): string
    {
        $provider = \Str::lower($meta->providerName);

        $view = match ($provider) {
            'instagram' => view('embed.instagram', ['meta' => $meta]),
            'reddit' => view('embed.reddit', ['meta' => $meta]),
            'telegram' => view('embed.telegram', ['meta' => $meta]),
            'twitter' => view('embed.twitter', ['meta' => $meta]),
            'youtube' => view('embed.youtube', ['meta' => $meta]),
            'vimeo' => view('embed.vimeo', ['meta' => $meta]),
            default => view('embed.link', ['meta' => $meta]),
        };

        return $view->render();
    }
}
