<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $titles = json_decode(file_get_contents(storage_path('stubs/posts.json')), true);

        foreach ($titles as $title) {
            $tags = Tag::inRandomOrder()->limit(random_int(1, 5))->get();

            \App\Models\Post::factory()
                ->hasAttached($tags)
                ->create([
                    'title' => $title,
                ]);
        }
    }
}
