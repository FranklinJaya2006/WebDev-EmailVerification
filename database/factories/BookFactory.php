<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    
    /* The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /* Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'author' => $this->faker->name(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'thn_terbit' => $this->faker->year(),
            'jml_halaman' => $this->faker->numberBetween(50, 500),
        ];
    }
}
