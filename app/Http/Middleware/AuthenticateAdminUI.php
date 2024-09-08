<?php

namespace App\Http\Middleware;

use App\Repositories\Interface\PermissionRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\JWTAuth;

class AuthenticateAdminUI
{    

    public function handle($request, Closure $next)
    {             
        $user = Auth::guard("admin-api")->user();                           
        if (!$user) {
            Session::put(config("app.URL_INTENDED",'url_intended'), url()->current());
            return redirect()->route("login");
        }   

        return $next($request);
    }
}

