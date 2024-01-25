<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        $topic = Topic::inRandomOrder()->first();
        $intro = $this->faker->paragraph(2);
        $createdAt = $this->faker->dateTimeBetween('-2 months');
        $imgVersion = $this->faker->randomNumber(2);

        $dimensions = $this->faker->randomElement([
            '900x400',
            '400x700',
            '400x400',
            '700x900',
            '1900x1080',
        ]);
        // $illustration = "https://source.unsplash.com/{$dimensions}?{$topic->slug}&crop&v={$imgVersion}";
        $illustration = "https://placehold.co/{$dimensions}?{$topic->slug}&crop&v={$imgVersion}";

        $actualTitle = $this->optional(60, $title);
        $url = $this->optional(80, $this->faker->url);
        $actualIllustration = $this->optional(80, $illustration);
        $actualIntro = $this->optional(50, $intro);
        $publishedAt = $this->optional(80, $createdAt);

        if ($url && $actualIllustration && $actualIntro) {
            if ($this->faker->boolean(50)) {
                $actualIntro = $this->faker->paragraphs(2, true);
            } else {
                $actualIllustration = $illustration;
            }
        }

        return [
            'title' => $actualTitle,
            'url' => $url,
            'illustration' => $actualIllustration,
            'intro' => $actualIntro,
            'author_id' => User::inRandomOrder()->first()->id,
            'topic_id' => $topic->id,
            'published_at' => $publishedAt,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    private function optional(int $chance, mixed $value): mixed
    {
        return $this->faker->boolean($chance) ? $value : null;
    }
}
