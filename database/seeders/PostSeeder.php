<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $titles = collect(json_decode(file_get_contents(storage_path('stubs/posts.json')), true))
            ->take(50);

        foreach ($titles as $title) {
            // $tags = Tag::inRandomOrder()->limit(random_int(1, 5))->get();

            \App\Models\Post::factory()
                // ->hasAttached($tags)
                // ->hasComments(random_int(0, 15))
                ->create([
                    'title' => $title,
                ]);
        }
    }
}
