<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictDevAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->guard('developer')->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access!',
            ], 403);
        }

//        return response()->json([
//            'status' => 'error',
//            'message' => 'Gotcha! Route is restricted. Please contact your administrator.',
//        ], 403);
//        if (!app()->environment('local')) {
//            return response()->json([
//                'status' => 'error',
//                'message' => 'Access denied! This route is restricted to the local environment.',
//            ], 403);
//        }

        return $next($request);
    }
}
