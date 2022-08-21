<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = \App\Models\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 3,
            'image' => 'https://via.placeholder.com/300.png?text='.$this->faker->sentence(1),
            'slug' => $this->faker->slug(3),
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(6),
            'status' => 'publish'
        ];
    }
}
