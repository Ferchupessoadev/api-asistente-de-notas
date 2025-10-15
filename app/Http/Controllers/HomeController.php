<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(data: Auth::user(), status: 200);
    }
}