<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EvaluationInstances>
 */
class EvaluationInstancesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            "type" => $this->faker->randomElement(['examen', 'tarea', 'proyecto', 'trabajo practico', 'participacion', 'actividad', 'otros']),
            "description" => $this->faker->sentence(),
            "fecha" => $this->faker->dateTime(),
            "nota" => $this->faker->numberBetween(1, 10),
        ];
    }
}
