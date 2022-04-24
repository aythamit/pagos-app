<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionUserMiddleware
{
    public function handle($request, Closure $next,$modulo,$permiso)
    {
        if(Auth::user()->hasPermiso($modulo,$permiso)){
            return $next($request);
        }
        abort(403);
    }
}
