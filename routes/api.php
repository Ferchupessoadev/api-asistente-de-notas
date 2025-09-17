<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return response()->json(['message' => 'API Asistente de Notas'], 200);
});

Route::get('/hola', function (Request $request) {
    return response()->json(['message' => 'API Asistente de Notas'], 200);
});
