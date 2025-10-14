
<?php

use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return response()->json(['message' => 'API Asistente de Notas'], 200);
});

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function () {
        return response()->json([
            'user' => User::all()
        ]);
    });

    Route::post('/logout', [LoginController::class, 'logout']);
});
