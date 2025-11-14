<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title'     => $this->faker->sentence,
            'content'   => $this->faker->paragraph,
            'author_id' => Author::factory(), // ✅ link to an author
            'published' => $this->faker->boolean,
        ];
    }
}