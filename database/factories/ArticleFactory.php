<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // faker is a library generate random data
            'title' => $this->faker->sentence(1),
            'content' => $this->faker->paragraph(3),
            'user-id' => User::inRandomOrder()->first(),
           
        ];
    }
}
