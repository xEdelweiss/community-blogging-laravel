<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = json_decode(file_get_contents(storage_path('stubs/tags.json')), true);

        foreach ($tags as $tag) {
            \App\Models\Tag::factory()->create([
                'name' => $tag['name'],
                'slug' => str($tag['name'])->slug(),
            ]);
        }

        return;
    }
}
