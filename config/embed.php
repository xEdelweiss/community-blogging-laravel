<?php

return [
    'cache' => [
        'store' => env('EMBED_CACHE_STORE', 'redis'),
        'ttl' => env('EMBED_CACHE_TTL', 60 * 60 * 24),
    ],
];
