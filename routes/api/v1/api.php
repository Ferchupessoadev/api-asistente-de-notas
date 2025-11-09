<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
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

    Route::post('/logout', [AuthController::class, 'logout']);
});


require __DIR__ . '/admin.php';
