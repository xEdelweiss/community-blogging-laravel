<?php

namespace App\Services\EmbedService;

use Carbon\Carbon;
use Embed\Detectors\ProviderName;
use Embed\Embed;
use Embed\Extractor;

class EmbedService
{
    private Embed $embed;

    public function __construct(Embed $embed)
    {
        $this->embed = $embed;
    }

    public function getVersion(): string
    {
        return EmbedMetaDto::VERSION;
    }

    public function get(string $url): EmbedMetaDto
    {
        $extractor = $this->getExtractor($url);

        $title = $this->isTitleMeaningful((string) $extractor->providerName)
            ? $extractor->title
            : null;

        return new EmbedMetaDto(
            $extractor->url,
            $title,
            $extractor->description,
            $extractor->image,
            $extractor->providerName,
            $extractor->favicon,
            $extractor->publishedTime ? Carbon::createFromTimestamp($extractor->publishedTime->getTimestamp())->diffForHumans() : null,
            $extractor->code
        );
    }

    private function getExtractor(string $url): Extractor
    {
        return $this->embed->get($url);
    }

    private function isTitleMeaningful(string $param): bool
    {
        return !in_array(\Str::lower($param), [
            'instagram',
            'telegram',
            'twitter',
        ]);
    }
}
