<?php

use App\Http\Controllers\CourseTeacherController;
use App\Http\Controllers\EvaluationInstancesController;
use App\Http\Controllers\SubjectTeacherController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum','teacher'])->group(function () {
    // Evaluations instances Routes
    Route::get('/evaluation-instances', [EvaluationInstancesController::class, 'index']);
    Route::post('/evaluation-instances', [EvaluationInstancesController::class, 'store']);
    Route::get('/evaluation-instances/{evaluationInstances}', [EvaluationInstancesController::class, 'show']);
    Route::put('/evaluation-instances/{evaluationInstances}', [EvaluationInstancesController::class, 'update']);
    Route::delete('/evaluation-instances/{evaluationInstances}', [EvaluationInstancesController::class, 'destroy']);

    // Courses taught by the teacher
    Route::get('/teacher/courses', [CourseTeacherController::class, 'index']);

    // subjects taught by the teacher especific course
    Route::get('/teacher/courses/{course}/subjects', [SubjectTeacherController::class, 'subjects']);

    Route::get('/evaluation-instances/subjects/{subject}/students/{student}', [EvaluationInstancesController::class, 'getBySubjectAndStudent']);
});
