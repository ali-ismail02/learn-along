<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;


class JWT
{
    public function handle(Request $request, Closure $next)
    {
        JWTAuth::parseToken()->authenticate();
        $request['userData'] = auth()->user();
        return $next($request);
    }
}
