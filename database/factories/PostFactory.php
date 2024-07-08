<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    // protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence();
        $slug = str($title)->slug();
        $content = $this->faker->paragraphs(6, true);
        $excerpt = Post::generateExcerpt($content);


        return [
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 5),
            'title' => $title,
            'content' => $content,
            'excerpt' => $excerpt,
            'status' => fake()->boolean(),
            'slug' => $slug,
            'image' => null,
            'content' => fake()->paragraph(),
        ];
    }
}
