<?php

namespace Database\Seeders;

use App\Models\EvaluationInstances;
use App\Models\Grades;
use App\Models\Student;
use Illuminate\Database\Seeder;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evaluation_instances = EvaluationInstances::all();
        $students = Student::all();

        foreach ($evaluation_instances as $evaluation_instance) {
            foreach ($students as $student) {
                $course = $evaluation_instance->subject->course;
                if ($student->course_id == $course->id) {
                    Grades::factory()->create([
                        'evaluation_instances_id' => $evaluation_instance->id,
                        'student_id' => $student->id
                    ]);
                }
            }
        }
    }
}
