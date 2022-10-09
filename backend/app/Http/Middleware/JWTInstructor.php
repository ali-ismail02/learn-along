<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;


class JWTInstructor
{
    public function handle(Request $request, Closure $next)
    {
        JWTAuth::parseToken()->authenticate();
        $request['userData'] = auth()->user();
        if($request['userData']['user_type'] != 2)
            return response()->json([
                "status" => "0",
                "message" => "Unauthorized"
            ]);
        return $next($request);
    }
}
