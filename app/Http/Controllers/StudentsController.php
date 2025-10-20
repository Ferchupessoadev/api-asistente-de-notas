<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $students = Student::all();

        return response()->json([
            'students' => $students,
            'message' => 'Listado de estudiantes',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        $student = Student::create($validatedData);

        return response()->json([
            'student' => $student,
            'message' => 'Estudiante creado exitosamente',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json([
            'student' => $student,
            'message' => 'Detalle del estudiante',
            'course' => $student->course,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Estudiante eliminado exitosamente',
        ], 200);
    }
}
