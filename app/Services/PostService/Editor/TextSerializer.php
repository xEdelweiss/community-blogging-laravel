<?php

namespace App\Services\PostService\Editor;

class TextSerializer extends \Tiptap\Core\TextSerializer
{
    protected $configuration = [
        'blockSeparator' => "\n",
        'removeEmptyLines' => true,
    ];

    public function process(array $value): string
    {
        $text = [];

        // transform document to object
        $this->document = json_decode(json_encode($value));

        $content = is_array($this->document->content) ? $this->document->content : [];

        foreach ($content as $node) {
            $text[] = $this->renderNode($node);
        }

        if ($this->configuration['removeEmptyLines']) {
            $text = array_filter($text);
        }

        return $this->joinNodes($text);
    }

    private function renderNode($node): string
    {
        $text = [];

        if (isset($node->content)) {
            foreach ($node->content as $nestedNode) {
                $text[] = $this->renderNode($nestedNode);
            }

            return $this->joinNodes($text);
        }

        if (isset($node->text)) {
            $text[] = htmlspecialchars($node->text, ENT_QUOTES, 'UTF-8');
        }

        return $this->joinNodes($text);
    }

    private function joinNodes(array $text): string
    {
        return implode($this->configuration['blockSeparator'], $text);
    }
}
