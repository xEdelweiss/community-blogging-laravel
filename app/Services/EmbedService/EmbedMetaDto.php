<?php

namespace App\Services\EmbedService;

use Carbon\Carbon;
use Embed\EmbedCode;
use Embed\Extractor;

readonly class EmbedMetaDto
{
    public const VERSION = '3';

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

    public static function makeFromExtractor(Extractor $extractor): self
    {
        return new self(
            $extractor->url,
            $extractor->title,
            $extractor->description,
            $extractor->image,
            $extractor->providerName,
            $extractor->favicon,
            $extractor->publishedTime ? Carbon::createFromTimestamp($extractor->publishedTime->getTimestamp())->diffForHumans() : null,
            $extractor->code
        );
    }
}
