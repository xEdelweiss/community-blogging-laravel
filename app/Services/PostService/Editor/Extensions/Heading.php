<?php

namespace App\Services\PostService\Editor\Extensions;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Heading extends Node
{
    public static $name = 'heading';

    public function addOptions()
    {
        return [
            'levels' => [1, 2, 3, 4, 5, 6],
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return array_map(function ($level) {
            return [
                'tag' => "h{$level}",
                'attrs' => [
                    'level' => $level,
                ],
            ];
        }, $this->options['levels']);
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        $hasLevel = in_array($node->attrs->level, $this->options['levels']);

        $level = $hasLevel ?
            $node->attrs->level :
            $this->options['levels'][0];

        $textAlign = $node->attrs->textAlign ?? null;
        $id = $node->attrs->id ?? null;

        $attributes = HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes);

        if ($textAlign) {
            $attributes['class'] ??= '';
            $attributes['class'] .= " text-{$textAlign}";
            $attributes['class'] = trim($attributes['class']);
        }

        if ($id) {
            $attributes['id'] = $id;
        }

        return [
            "h{$level}",
            $attributes,
            0,
        ];
    }
}
