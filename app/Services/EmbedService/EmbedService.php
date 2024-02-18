<?php

namespace App\Services\EmbedService;

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
        return EmbedMetaDto::makeFromExtractor($this->getExtractor($url));
    }

    private function getExtractor(string $url): Extractor
    {
        return $this->embed->get($url);
    }
}
