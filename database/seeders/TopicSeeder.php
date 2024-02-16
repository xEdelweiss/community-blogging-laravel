<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Topic::factory()->create([
            'title' => 'Military',
            'slug' => 'military',
            'description' => 'Military topics',
            'image' => 'img/topic/military.png',
        ]);

        \App\Models\Topic::factory()->create([
            'title' => 'Games',
            'slug' => 'games',
            'description' => 'Games topics',
            'image' => 'img/topic/games.png',
        ]);

        \App\Models\Topic::factory()->create([
            'title' => 'Politics',
            'slug' => 'politics',
            'description' => 'Political topics',
            'image' => 'img/topic/politics.png',
        ]);

        \App\Models\Topic::factory()->create([
            'title' => 'Sports',
            'slug' => 'sports',
            'description' => 'Sports topics',
            'image' => 'img/topic/sports.png',
        ]);

        \App\Models\Topic::factory()->create([
            'title' => 'Technology',
            'slug' => 'technology',
            'description' => 'Technology topics',
            'image' => 'img/topic/technology.png',
        ]);

        \App\Models\Topic::factory()->create([
            'title' => 'Literature',
            'slug' => 'literature',
            'description' => 'Literature topics',
            'image' => 'img/topic/literature.png',
        ]);
    }
}
