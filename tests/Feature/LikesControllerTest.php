<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

test('can like post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this->actingAs($user)->post(route('like'), [
        'likeable_id' => $post->id,
        'likeable_type' => 'post',
    ]);

    $response->assertJson([
        'likes' => 1,
    ]);
});

test('can unlike post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $user->like($post);

    $response = $this->actingAs($user)->delete(route('like'), [
        'likeable_id' => $post->id,
        'likeable_type' => 'post',
    ]);

    $response->assertJson([
        'likes' => 0,
    ]);
});

test('can like comment', function () {
    $user = User::factory()->create();
    $comment = Comment::factory()->create();

    $response = $this->actingAs($user)->post(route('like'), [
        'likeable_id' => $comment->id,
        'likeable_type' => 'comment',
    ]);

    $response->assertJson([
        'likes' => 1,
    ]);
});

test('can unlike comment', function () {
    $user = User::factory()->create();
    $comment = Comment::factory()->create();

    $user->like($comment);

    $response = $this->actingAs($user)->delete(route('like'), [
        'likeable_id' => $comment->id,
        'likeable_type' => 'comment',
    ]);

    $response->assertJson([
        'likes' => 0,
    ]);
});

test('can not like if not verified', function () {
    $user = User::factory()->unverified()->create();
    $post = Post::factory()->create();

    $response = $this->actingAs($user)->post(route('like'), [
        'likeable_id' => $post->id,
        'likeable_type' => 'post',
    ]);

    $response->assertForbidden();
});
