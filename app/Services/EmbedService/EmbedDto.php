<?php

namespace App\Services\EmbedService;

use Carbon\Carbon;
use Embed\Extractor;

readonly class EmbedDto
{
    public const VERSION = '1';

    public function __construct(
        public string $title,
        public string $description,
        public string $imageUrl,
        public string $providerName,
        public string $iconUrl,
        public ?string $publishedAt
    ) {
    }

    public static function makeFromExtractor(Extractor $extractor): self
    {
        return new self(
            $extractor->title,
            $extractor->description,
            $extractor->image,
            $extractor->providerName,
            $extractor->favicon,
            $extractor->publishedTime ? Carbon::createFromTimestamp($extractor->publishedTime->getTimestamp())->diffForHumans() : null
        );
    }
}
