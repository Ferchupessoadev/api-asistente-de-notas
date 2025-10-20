<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year' => $this->faker->numberBetween(1, 6),
            'division' => $this->faker->numberBetween(1, 5),
            'orientation' => $this->faker->randomElement(['computación', 'Gastronomia', 'Adm. de empresas']),
        ];
    }
}
