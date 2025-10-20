<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function getStudentsByCourse(Course $course)
    {
        $students = $course->students;

        return response()->json($students, 200);
    }

    public function index(): JsonResponse
    {
        $courses = Course::all();

        return response()->json($courses, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'year' => ['required', 'integer'],
            'division' => ['required', 'integer'],
            'orientation' => ['required', 'string', 'max:255'],
        ]);

        $course = Course::create($validatedData);

        return response()->json([
            'course' => $course,
            'message' => 'Curso creado exitosamente',
        ], 201);
    }

    public function show(Course $course)
    {
        return response()->json($course, 200);
    }

    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'year' => ['sometimes', 'integer'],
            'division' => ['sometimes', 'integer'],
            'orientation' => ['sometimes', 'string', 'max:255'],
        ]);

        $course->update($validatedData);

        return response()->json([
            'course' => $course,
            'message' => 'Curso actualizado exitosamente',
        ], 200);
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json([
            'message' => 'Curso eliminado exitosamente',
        ], 200);
    }
}
