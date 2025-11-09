<?php

use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;


Route::midelleware(['auth:sanctum','teacher'])->group(function () {
    Route::get('/subjects', [SubjectController::class, 'index']);
})
