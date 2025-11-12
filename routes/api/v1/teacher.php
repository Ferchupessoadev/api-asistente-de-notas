<?php

use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\EvaluationInstancesController;
use App\Http\Controllers\SubjectTeacherController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum','teacher'])->group(function () {
    // Evaluations instances Routes
    Route::get('/evaluation-instances', [EvaluationInstancesController::class, 'index']);
    Route::post('/evaluation-instances', [EvaluationInstancesController::class, 'store']);
    Route::get('/evaluation-instances/{evaluationInstance}', [EvaluationInstancesController::class, 'show']);
    Route::put('/evaluation-instances/{evaluationInstance}', [EvaluationInstancesController::class, 'update']);
    Route::delete('/evaluation-instances/{evaluationInstance}', [EvaluationInstancesController::class, 'destroy']);

    // Courses taught by the teacher
    Route::get('/teacher/courses', [CourseTeacherController::class, 'index']);

    // Subjects taught by the teacher
    Route::get('/teacher/courses/{course}/subjects', [SubjectTeacherController::class, 'subjects']);
});
