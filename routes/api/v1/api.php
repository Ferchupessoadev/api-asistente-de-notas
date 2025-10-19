<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get(uri: '/', action: function (Request $request) {
    return response()->json(['message' => 'API Asistente de Notas'], 200);
});

Route::post(uri: '/login', action: [AuthController::class, 'login']);
Route::post(uri: '/register', action: [AuthController::class, 'register']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get(uri: '/me', action: [HomeController::class, 'index']);

    Route::get(uri: '/students', action: [StudentsController::class, 'index']);

    Route::post(uri: '/logout', action: [AuthController::class, 'logout']);
});
