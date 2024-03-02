<?php

use App\Models\Post;
use App\Models\User;
use function Pest\Laravel\{actingAs, assertDatabaseMissing, postJson, assertDatabaseHas};

test('tracks are saved', function () {
    $post1 = Post::factory()->create();
    $post2 = Post::factory()->create();

    $response = postJson('/api/view-track', [
        'batch' => [
            [
                'viewable_id' => $post1->id,
                'viewable_type' => 'post',
                'action' => 'view'
            ],
            [
                'viewable_id' => $post1->id,
                'viewable_type' => 'post',
                'action' => 'read'
            ],
            [
                'viewable_id' => $post2->id,
                'viewable_type' => 'post',
                'action' => 'view'
            ],
        ]
    ]);

    $response
        ->assertStatus(200)
        ->assertJson([
            'message' => 'All actions were successful',
            'errors' => []
        ]);

    assertDatabaseHas('posts', [
        'id' => $post1->id,
        'views' => 1,
        'reads' => 1
    ]);

    assertDatabaseHas('posts', [
        'id' => $post2->id,
        'views' => 1,
        'reads' => 0
    ]);
});

test('unique view is saved for authenticated user', function () {
    $post = Post::factory()->create();
    $user = User::factory()->create();

    $response = actingAs($user)
        ->postJson('/api/view-track', [
            'batch' => [
                [
                    'viewable_id' => $post->id,
                    'viewable_type' => 'post',
                    'action' => 'view'
                ],
            ]
        ]);

    $response->assertStatus(200);

    assertDatabaseHas('unique_views', [
        'viewable_id' => $post->id,
        'viewable_type' => Post::class,
        'user_id' => $user->id,
    ]);
});

test('unique view is not saved for guest', function () {
    $post = Post::factory()->create();

    $response = postJson('/api/view-track', [
        'batch' => [
            [
                'viewable_id' => $post->id,
                'viewable_type' => 'post',
                'action' => 'view'
            ],
        ]
    ]);

    $response->assertStatus(200);

    assertDatabaseMissing('unique_views', [
        'viewable_id' => $post->id,
        'viewable_type' => Post::class,
    ]);
});

test('single unique views is created per user/viewable', function () {
    $post = Post::factory()->create();
    $user = User::factory()->create();

    $payload = [
        'batch' => [
            [
                'viewable_id' => $post->id,
                'viewable_type' => 'post',
                'action' => 'view'
            ],
            [
                'viewable_id' => $post->id,
                'viewable_type' => 'post',
                'action' => 'view'
            ],
        ]
    ];

    actingAs($user)
        ->postJson('/api/view-track', $payload)
        ->assertStatus(200);

    actingAs($user)
        ->postJson('/api/view-track', $payload)
        ->assertStatus(200);

    assertDatabaseHas('unique_views', [
        'viewable_id' => $post->id,
        'viewable_type' => Post::class,
        'user_id' => $user->id,
    ]);
});

test('error is returned when post does not exist', function () {
    $response = postJson('/api/view-track', [
        'batch' => [
            [
                'viewable_id' => 999,
                'viewable_type' => 'post',
                'action' => 'view'
            ],
        ]
    ]);

    $response
        ->assertStatus(400)
        ->assertJson([
            'message' => 'All actions failed',
            'errors' => ['Entry [post] with id [999] not found']
        ]);
});

test('error specifies if some actions failed', function () {
    $post = Post::factory()->create();

    $response = postJson('/api/view-track', [
        'batch' => [
            [
                'viewable_id' => 999,
                'viewable_type' => 'post',
                'action' => 'view'
            ],
            [
                'viewable_id' => $post->id,
                'viewable_type' => 'post',
                'action' => 'view'
            ],
        ]
    ]);

    $response
        ->assertStatus(400)
        ->assertJson([
            'message' => 'Some actions failed',
            'errors' => ['Entry [post] with id [999] not found']
        ]);
});

test('validation error is returned when action is invalid', function () {
    $response = postJson('/api/view-track', [
        'batch' => [
            [
                'viewable_id' => 1,
                'viewable_type' => 'post',
                'action' => 'invalid'
            ],
        ]
    ]);

    $response
        ->assertStatus(422)
        ->assertJson([
            'message' => 'The selected batch.0.action is invalid.',
            'errors' => [
                'batch.0.action' => [
                    'The selected batch.0.action is invalid.'
                ]
            ]
        ]);
});

test('repeated actions are ignored', function () {
    $post = Post::factory()->create();

    $payload = [
        'batch' => [
            [
                'viewable_id' => $post->id,
                'viewable_type' => 'post',
                'action' => 'view'
            ]
        ]
    ];

    postJson('/api/view-track', $payload)
        ->assertStatus(200)
        ->assertJson([
            'message' => 'All actions were successful',
            'errors' => []
        ]);

    postJson('/api/view-track', $payload)
        ->assertStatus(200)
        ->assertJson([
            'message' => 'No actions required',
            'errors' => []
        ]);

    assertDatabaseHas('posts', [
        'id' => $post->id,
        'views' => 1,
    ]);
});
