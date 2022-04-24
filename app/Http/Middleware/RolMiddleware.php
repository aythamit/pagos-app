<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    // Comprobamos si el usuario logueado tiene acceso a esta ruta
    public function handle($request, Closure $next,$rol)
    {

        $tipo = Auth::user()->tipo;
        if($tipo === $rol){
            return $next($request);
        }else{
            abort(403);
        }

    }
}
