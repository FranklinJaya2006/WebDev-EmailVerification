<?php

namespace Database\Factories;

use App\Models\Newspaper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Newspaper>
 */
class NewspaperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author' => $this->faker->name(),
            'title' => $this->faker->sentence(),
            'publisher' => $this->faker->name(),
            'category' => $this->faker->randomElement([
                'Politics', 
                'Economy', 
                'Sports', 
                'Entertainment', 
                'Technology', 
                'Health', 
                'Education', 
                'Science', 
                'Environment', 
                'World News',
                'Lifestyle',
                'Travel'
            ]),
            'thn_terbit' => $this->faker->year(),
        ];
    }
}
