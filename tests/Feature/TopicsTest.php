<?php

test('topics are visible on main page', function () {
    /** @var Illuminate\Testing\TestResponse $response */
    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertSeeText([
            'Military',
            'Games',
            'Politics',
            'Sports',
            'Technology',
            'Literature',
        ])
        ->assertSee([
            '/topics/military',
            '/topics/games',
            '/topics/politics',
            '/topics/sports',
            '/topics/technology',
            '/topics/literature',
        ]);

    $response->assertStatus(200);
});
