<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function (Request $request) {
    return response()->json(['message' => 'API Asistente de Notas'], 200);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', [HomeController::class, 'index']);

    Route::get('/courses/{course}/students', [CoursesController::class, 'getStudentsByCourse']);

    Route::middleware(['admin'])->group(function () {
        // Subject Routes
        Route::get('/subjects', [SubjectController::class, 'index']);


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

    Route::post('/logout', [AuthController::class, 'logout']);
});
