<?php

namespace Database\Seeders;

use App\Models\EvaluationInstances;
use App\Models\Student;
use App\Models\Subject;
use Database\Factories\EvaluationInstancesFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationInstancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recorremos todas las materias
        $subjects = Subject::with('course')->get();

        foreach ($subjects as $subject) {
            // Buscamos los estudiantes que están en el mismo curso que la materia
            $students = Student::where('course_id', $subject->course_id)->get();

            if ($students->isEmpty()) {
                continue; // Si el curso no tiene estudiantes, pasamos a la siguiente materia
            }

            // Creamos entre 1 y 5 evaluaciones por estudiante en esa materia
            foreach ($students as $student) {
                EvaluationInstances::factory(rand(1, 5))->create([
                    'subject_id' => $subject->id,
                    'student_id' => $student->id,
                ]);
            }
        }
    }
}
