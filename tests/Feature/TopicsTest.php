<?php

test('topics are visible on main page', function () {
    /** @var Illuminate\Testing\TestResponse $response */
    $response = $this->get('/latest');

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
            '/latest/military',
            '/latest/games',
            '/latest/politics',
            '/latest/sports',
            '/latest/technology',
            '/latest/literature',
        ]);

    $response->assertStatus(200);
});
