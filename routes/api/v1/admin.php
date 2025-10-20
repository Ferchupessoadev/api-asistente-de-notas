<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.sanctum','admin'])->group(function () {
    // Subject Routes
    Route::get('/subjects', [SubjectController::class, 'index']);
    Route::get('/subjects/{subject}', [SubjectController::class, 'show']);
    Route::post('/subjects/{subject}', [SubjectController::class, 'store']);
    Route::put('/subjects/{subject}', [SubjectController::class, 'update']);
    Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy']);

    // Courses Routes
    Route::get('/courses', [CoursesController::class, 'index']);
    Route::get('/courses/{course}', [CoursesController::class, 'show']);
    Route::post('/courses', [CoursesController::class, 'store']);
    Route::put('/courses/{course}', [CoursesController::class, 'update']);
    Route::delete('/courses/{course}', [CoursesController::class, 'destroy']);

    // Student Routes
    Route::get('/students', [StudentsController::class, 'index']);
    Route::get('/students/{student}', [StudentsController::class, 'show']);
    Route::post('/students', [StudentsController::class, 'store']);
    Route::put('/students/{student}', [StudentsController::class, 'update']);
    Route::delete('/students/{student}', [StudentsController::class, 'destroy']);
});