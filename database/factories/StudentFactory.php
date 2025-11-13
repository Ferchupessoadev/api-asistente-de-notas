<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courses = Course::all();

        if ($courses->isEmpty()) {
            $course = Course::factory()->create();
        } else {
            $course = $this->faker->randomElement($courses);
        }

        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'course_id' => $course->id,
        ];
    }
}
