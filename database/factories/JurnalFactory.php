<?php

namespace Database\Factories;

use App\Models\Jurnal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jurnal>
 */
class JurnalFactory extends Factory
{
    /* The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jurnal::class;

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
            'jml_halaman' => $this->faker->numberBetween(50, 1000),
        ];
    }
}
