<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Authorization extends PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {           
            
        try {                        
            $user = Auth::guard("admin-api")->user();                                                               
            if(!$this->check($user))
                return redirect()->route("web.index");
        } catch (\Exception $e) {
            Session::put(config("app.URL_INTENDED",'url_intended'), url()->current());
            return redirect()->route("login");
        }
        return $next($request); 
    }
}
