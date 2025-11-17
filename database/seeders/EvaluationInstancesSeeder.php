<?php

namespace Database\Seeders;

use App\Models\EvaluationInstances;
use App\Models\Subject;
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
            EvaluationInstances::factory(rand(1, 10))->create([
                'subject_id' => $subject->id,
            ]);
        }
    }
}
