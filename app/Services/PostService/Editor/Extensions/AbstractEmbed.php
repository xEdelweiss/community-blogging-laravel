<?php

namespace App\Services\PostService\Editor\Extensions;

use Tiptap\Core\Node;

class AbstractEmbed extends Node
{
    public static $marks = '';

    public function parseHTML()
    {
        $name = static::$name;

        return [
            [
                'tag' => "div[data-type=\"{$name}\"]",
                'getAttrs' => function ($DOMNode) {
                    return [
                        'src' => $DOMNode->getAttribute('x-embed'),
                    ];
                },
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'src' => [
                'default' => null,
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return [
            'div',
            [
                'data-type' => static::$name,
                'x-embed' => $node->attrs->src,
            ],
        ];
    }
}
