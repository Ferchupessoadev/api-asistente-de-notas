<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject = Subject::with('teacher')->with('course')->get();

        $jsonResponse = [
            'subject' => $subject,
            'message' => 'No se encuentran Asignaturas',
        ];

        if($subject->count() > 0)
        {
            $jsonResponse = $subject;
        }

        return response()->json($jsonResponse, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'teacher_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $subject = Subject::create($validatedData);

        return response()->json([
            'subject' => $subject,
            'message' => 'Asignatura creada exitosamente',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject = Subject::with('teacher')->with('course')->find($subject->id);

        return response()->json([
            'subject' => $subject
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'course_id' => ['sometimes', 'string', 'exists:courses,id'],
            'teacher' => ['sometimes', 'string']
        ]);

        $subject->update($validatedData);

        return response()->json([
            'message' => 'Asignatura editada correctamente.',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json([
            "message" => 'Asignatura eliminada correctamente',
        ], 201);
    }
}
