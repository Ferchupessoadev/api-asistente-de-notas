<?php

namespace App\Http\Controllers;

use App\Models\EvaluationInstances;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationInstancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $instances = EvaluationInstances::whereHas('teacher', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();

        if ($instances->isEmpty()) {
            return response()->json([
                'message' => 'No evaluation instances found for this teacher.',
                "instances" => $instances,
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
        $user = Auth::user();
        
        $subject = $evaluationInstances->subject;
        $teacher = $subject->teacher;

        if ($user->id !== $teacher->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        return response()->json($evaluationInstances, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvaluationInstances $evaluationInstances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EvaluationInstances $evaluationInstances)
    {
        //
    }
}
