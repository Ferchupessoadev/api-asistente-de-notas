<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();

        if ($request->has('search')) {
            $users = User::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->get();
        }

        return response()->json(UserResource::collection($users), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterFormRequest $request)
    {
        $user = User::create($request->validated());
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('user');

        return response()->json(new UserResource($user), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(new UserResource($user), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!Auth::user()->hasRole('admin')) {
            return response()->json(['message' => 'Not Found.'], 404);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'string', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'name' => $validated['name'] ?? $user->name,
            'email' => $validated['email'] ?? $user->email
        ]);

        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
            $user->save();
        }

        return response()->json(new UserResource($user), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === Auth::user()->id) {
            return response()->json(['message' => 'No puedes eliminar tu propio usuario, imbecil.'], 403);
        }

        if ($user->hasRole('admin')) {
            return response()->json(['message' => 'No puedes eliminar a un administrador.'], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente.',
            'user' => new UserResource($user)
        ], 200);
    }


    public function assignRoleToUser(User $user, string $role): JsonResponse
    {
        if (!Role::where('name', $role)->exists()) {
            return response()->json(['error' => 'El rol no existe.', 'roles' => Role::all()->pluck('name')], 404);
        }

        $user->assignRole($role);

        return response()->json(['message' => 'Rol asignado correctamente.', new UserResource($user)], 200);
    }
}
