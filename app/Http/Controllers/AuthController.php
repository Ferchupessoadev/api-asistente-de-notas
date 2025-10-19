<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }

    public function register(RegisterFormRequest $request): JsonResponse  
    {

        User::create(attributes: $request->validated());
        $headers = [];
        
        return response()->json(data:[
            'message' => 'Usuario creado con exito',
        ], status: 200, headers: $headers);
    }       

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Sesion cerrada'], 200);
    }
}

