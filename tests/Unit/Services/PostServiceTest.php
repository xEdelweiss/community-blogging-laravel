<?php

use App\Services\PostService\Editor\PostEditor;
use App\Services\PostService\PostService;

beforeEach(function () {
    $this->service = new PostService(
        new PostEditor()
    );
});

test('simple content can be converted to text', function () {
    $content = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Hello, world!',
                    ],
                ],
            ],
        ],
    ];

    expect($this->service->contentToText($content))
        ->toEqual('Hello, world!');
});

test('multiple nodes can be converted to text', function () {
    $content = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 1,
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Hello, world!',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Goodbye, world!',
                    ],
                ],
            ],
        ],
    ];

    expect($this->service->contentToText($content))
        ->toEqual("Hello, world!\nGoodbye, world!");
});

test('all text nodes are supported', function () {
    $content = json_decode(file_get_contents(__DIR__ . '/post-content.json'), true, 512, JSON_THROW_ON_ERROR);

    expect($this->service->contentToText($content))
        ->toMatchSnapshot('post-content.txt');
});
