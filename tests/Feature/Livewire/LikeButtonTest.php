<?php

use App\Livewire\LikeButton;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(LikeButton::class)
        ->assertStatus(200);
});
