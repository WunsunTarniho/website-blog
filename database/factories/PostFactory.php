<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Process\FakeProcessResult;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

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
        return [
            'title' => fake()->sentence(10),
            'slug' => fake()->sentence(10),
            'user_id' => 1,
            'except' => fake()->sentence(30),
            'body' => fake()->paragraph(15),
            'category_id' => fake()->numberBetween(1, 7),
        ];
    }
}
