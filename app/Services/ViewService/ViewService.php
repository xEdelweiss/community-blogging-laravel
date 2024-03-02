<?php

namespace App\Services\ViewService;

use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;

class ViewService
{
    private Repository $cache;
    private int $ttl;

    public function __construct(CacheManager $cacheManager)
    {
        $this->cache = $cacheManager->store(config('services.view_tracker.cache.store'));
        $this->ttl = config('services.view_tracker.cache.ttl');
    }

    public function wasRecentlyTracked(ViewActionDto $dto): bool
    {
        return $this->cache->has(
            $this->getCacheKey($dto)
        );
    }

    public function markRecentlyTracked(ViewActionDto $dto): void
    {
        $this->cache->put(
            $this->getCacheKey($dto),
            true,
            $this->ttl,
        );
    }

    private function getCacheKey(ViewActionDto $action): string
    {
        return $action->getKey('views');
    }
}
