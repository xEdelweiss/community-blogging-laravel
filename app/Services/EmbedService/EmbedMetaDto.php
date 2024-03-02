<?php

namespace App\Services\EmbedService;

use Embed\EmbedCode;

readonly class EmbedMetaDto
{
    public const VERSION = '5';

    public function __construct(
        public string $url,
        public ?string $title,
        public ?string $description,
        public ?string $imageUrl,
        public string $providerName,
        public string $iconUrl,
        public ?string $publishedAt,
        public ?EmbedCode $code,
    ) {
    }
}
