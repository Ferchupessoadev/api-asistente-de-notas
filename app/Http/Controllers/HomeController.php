<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(data: Auth::user(), status: 200);
    }


   public function getAvatar()
    {
        $user = Auth::user();

        if (!$user->avatar || !Storage::disk('local')->exists($user->avatar)) {
            return response()->json(['message' => 'Avatar not found'], 404);
        }

        $file = Storage::disk('local')->get($user->avatar);
        $mime = Storage::disk('local')->mimeType($user->avatar);

        return response($file, 200)->header('Content-Type', $mime);
    }

    public function setAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        // Opcional: eliminar avatar anterior para no acumular archivos
        if ($user->avatar && Storage::disk('local')->exists($user->avatar)) {
            Storage::disk('local')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', ['disk' => 'local']);

        $user->avatar = $path;
        $user->save();

        return response()->json($user->only(['id', 'name', 'avatar']), 200);
    }
}
