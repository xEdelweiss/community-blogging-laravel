<?php

use App\Models\Post;
use App\Models\Tag;

test('tags can be added with sync', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory(3)->create();

    $post->syncTags($tags->pluck('name')->toArray());

    $this->assertEquals($tags->pluck('name'), $post->tags->pluck('name'));
});

test('tags can be synced without detaching', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory(3)->create();

    $post->syncTags($tags->pluck('name')->toArray());
    $post->syncTags($tags->pluck('name')->toArray());

    $this->assertEquals($tags->pluck('id'), $post->tags->pluck('id'));
});

test('tags can be synced with new tags', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory(3)->create();

    $post->syncTags($tags->pluck('name')->toArray());
    $post->syncTags(['new tag']);

    $this->assertEquals(['new tag'], $post->tags->pluck('name')->toArray());
});

test('tags can be synced with new tags and existing tags', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory(3)->create();

    $post->syncTags($tags->pluck('name')->toArray());
    $post->syncTags(['new tag', $tags->first()->name]);

    $this->assertEquals([$tags->first()->name, 'new tag'], $post->tags->pluck('name')->toArray());
});

test('tags can be removed with sync', function () {
    $post = Post::factory()->create();
    $tags = Tag::factory(3)->create();

    $post->syncTags($tags->pluck('name')->toArray());
    $post->syncTags([]);

    $this->assertEquals(0, $post->tags->count());
});
