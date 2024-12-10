<?php

namespace Database\Factories;

use App\Models\Cd;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cd>
 */
class CdFactory extends Factory
{

    protected $model = Cd::class;
    
    public function definition(): array
    {
        return [
            'author' => $this->faker->name(),
            'title' => $this->faker->sentence(),
            'artist' => $this->faker->name(),
            'genre' => $this->faker->randomElement([
                'Science Fiction', 
                'Fantasy', 
                'Romance', 
                'Horror', 
                'Thriller', 
                'History', 
                'Biography', 
                'Mystery', 
                'Non-Fiction', 
                'Adventure'
            ]),
            'thn_terbit' => $this->faker->year(),
        ];
    }
}
