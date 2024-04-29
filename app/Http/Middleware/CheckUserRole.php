<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Verificar si el usuario tiene el rol adecuado
            if ($request->user()->role === $role) {
                return $next($request); // Pasar la solicitud al siguiente middleware o controlador
            }
        }

        // Si el usuario no tiene el rol adecuado, redirigirlo a una página de acceso denegado
        return redirect()->route('access.denied');
    }
}
