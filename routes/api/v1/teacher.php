<?php

use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\SubjectController;
use App\Models\EvaluationInstances;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum','teacher'])->group(function () {
    // Evaluations instances Routes
    Route::get('/evaluation-instances', [EvaluationInstances::class, 'index']);

    Route::get('/courses/teacher', [CourseTeacherController::class, 'index']);
});
