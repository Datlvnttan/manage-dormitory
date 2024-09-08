<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertBooleans
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        foreach ($request->all() as $key => $value) {
            if ($value === 'true' || $value === 'false') {
                $request->merge([$key => filter_var($value, FILTER_VALIDATE_BOOLEAN)]);
            }
            // else if($value == "on")
            //     $request->merge([$key => true]);
        }

        return $next($request);
    }
}
