<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dvd;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DvdModel>
 */
class DvdFactory extends Factory
{
    protected $model = Dvd::class;

    /*
     * Define the model's default state.
     *
     * @return array
     */
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
