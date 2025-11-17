<?php

namespace App\Http\Controllers;

use App\Models\EvaluationInstances;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationInstancesController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $instances = EvaluationInstances::with('grades.student')->with('subject')
            ->whereHas('subject', function ($query) use ($user) {
                $query->whereHas('teacher', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                });
            })->get();

        if ($instances->isEmpty()) {
            return response()->json([
                'message' => 'Not Found.',
            ], 404);
        }

        return response()->json($instances, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'fecha' => 'required|date',
            'nota' => 'required|numeric',
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subject,id',
        ]);

        $user = Auth::user();
        $student = Student::find($validated['student_id']);
        $subject = Subject::find($validated['subject_id']);
        $course = $student->course;
        $teacher = $subject->teacher;


        if ($user->id !== $teacher->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if ($subject->course_id !== $course->id) {
            return response()->json(['message' => 'The subject does not belong to the student\'s course.'], 400);
        }

        $evaluationInstance = EvaluationInstances::create($validated);


        return response()->json([
            'message' => 'Instancias de evaluación creada con exito',
            'instances' => $evaluationInstance
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluationInstances $evaluationInstances)
    {
        $this->authorize('view', $evaluationInstances);

        return response()->json($evaluationInstances, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvaluationInstances $evaluationInstances)
    {
        $this->authorize('update', $evaluationInstances);

        $validated = $request->validate([
            'type' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'fecha' => ['sometimes', 'date'],
            'nota' => ['sometimes', 'numeric'],
        ]);

        $evaluationInstances->update($validated);

        return response()->json([
            'message' => 'Instancias de evaluación actualizada con exito',
            'instances' => $evaluationInstances
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluationInstances $evaluationInstances)
    {
        $this->authorize('delete', $evaluationInstances);

        $evaluationInstances->delete();

        return response()->json(['message' => 'Instancias de evaluación eliminada con exito'], 200);
    }

    public function getBySubjectAndStudent(Subject $subject, Student $student)
    {
        $this->authorize('viewInstancesBySubjectAndStudent', $subject);

        // $data = EvaluationInstances::where('subject_id', $subject->id)
        //     ->where('student_id', $student->id)
        //     ->whereHas('subject', function ($query) use ($user) {
        //         $query->where('teacher_id', $user->id);
        //     })
        //     ->get();

        // if ($data->isEmpty()) {
        //     return response()->json([
        //         'message' => 'Not Found.',
        //     ], 404);
        // }
        //

        return response()->json([
            "message" => "TODO",
        ], 200);
    }
}
