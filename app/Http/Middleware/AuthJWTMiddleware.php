<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthJWTMiddleware extends PermissionMiddleware
{
    public function handle($request, Closure $next)
    {                              
        try {
            // $user = JWTAuth::parseToken()->authenticate();
            $user = Auth::guard("admin-api")->user();                                       
            if(!$this->check($user))
                return response()->json(['message' => 'Unauthorized'], 401); 
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
