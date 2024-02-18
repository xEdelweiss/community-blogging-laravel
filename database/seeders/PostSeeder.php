<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $titles = collect(json_decode(file_get_contents(storage_path('stubs/posts.json')), true))
            ->take(50);

        $maxTitleLength = 150;

        foreach ($titles as $title) {
            \App\Models\Post::factory()
                ->create([
                    'title' => str($title)->substr(0, $maxTitleLength),
                ]);
        }
    }
}
