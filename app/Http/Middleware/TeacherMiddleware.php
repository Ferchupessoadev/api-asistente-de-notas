<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user || (!$user->hasRole('teacher') && !$user->hasRole('admin')))
        {
            return response()->json([
                'message' => 'Resource forbidden for non-teacher users',
            ], 403);
        }

        return $next($request);
    }
}
