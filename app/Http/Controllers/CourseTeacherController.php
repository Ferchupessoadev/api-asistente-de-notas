<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;


class CourseTeacherController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('teacher')) {
            $courses = Course::whereHas('subjects', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->get();

            return response()->json($courses, 200);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }


    public function subjects(Course $course)
    {
        $user = Auth::user();

        // Verificamos si el profesor enseña al menos una materia en este curso
        $teachesInThisCourse = $course->subjects()
            ->where('teacher_id', $user->id)
            ->exists();

        if (!$teachesInThisCourse) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        if ($user->hasRole('teacher')) {
            $subjects = $course->subjects()
                ->where('teacher_id', $user->id)
                ->get();

            return response()->json($subjects, 200);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
