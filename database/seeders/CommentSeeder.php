<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add comment threads to posts

        \App\Models\Post::all()->each(function ($post) {
            $comments = Comment::factory(random_int(0, 7))->create([
                'post_id' => $post->id,
            ]);

            $this->addSubComments($comments);
        });
    }

    private function addSubComments(Collection $comments, int $depth = 0, int $maxDepth = 3): void
    {
        if ($depth >= $maxDepth) {
            return;
        }

        $maxCommentsOnDepth = [
            0 => 7,
            1 => 3,
            2 => 1,
        ][$depth];

        $probabilityOnDepth = [
            0 => 50,
            1 => 30,
            2 => 10,
        ][$depth];

        $comments->each(function ($comment) use ($depth, $maxDepth, $maxCommentsOnDepth, $probabilityOnDepth) {
            if (random_int(0, 100) > $probabilityOnDepth) {
                return;
            }

            $subComments = Comment::factory(random_int(0, $maxCommentsOnDepth))->create([
                'post_id' => $comment->post_id,
                'parent_id' => $comment->id,
            ]);

            $this->addSubComments($subComments, $depth + 1, $maxDepth);
        });
    }
}
