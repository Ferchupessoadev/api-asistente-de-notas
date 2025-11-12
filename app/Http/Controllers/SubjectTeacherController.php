<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function subjects(Request $request, Course $course)
    {
        $authUser = Auth::user();

        if (!$authUser->hasAnyRole(['teacher', 'admin'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user = $authUser;
        if ($authUser->hasRole('admin') && $request->filled('user_id')) {
            $user = User::find($request->user_id);

            if (!$user || !$user->hasRole('teacher')) {
                return response()->json(['message' => 'User not found or not a teacher'], 404);
            }
        }

        $subjects = $course->subjects()
            ->where('teacher_id', $user->id)
            ->with('teacher')
            ->get();

        if ($subjects->isEmpty()) {
            return response()->json(['message' => 'No subjects found'], 404);
        }

        return response()->json($subjects, 200);
    }
}
