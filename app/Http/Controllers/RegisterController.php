<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function register(RegisterFormRequest $request): JsonResponse  
    {

        User::create(attributes: $request->validated());
        $headers = [];
        
        return response()->json(data:[
            'message' => 'Usuario creado con exito',
        ], status: 200, headers: $headers);
    }
}