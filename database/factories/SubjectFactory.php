<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubjectFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $users = User::all()->where('id', '!=', 1);

        $user = $this->faker->randomElement($users);

        $courses = Course::all();

        $course = $this->faker->randomElement($courses);

        return [
            'name' => $this->faker->word(),
            'course_id' => $course->id,
            'teacher_id' => $user->id,
        ];
    }
}
