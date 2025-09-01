<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario no está autenticado e intentar entrar a una página de autenticación, redirigir al inicio de sesión
        if(!Session()->has('loginId')){
            return redirect('login')->with('fail', 'Necesitas iniciar sesión para acceder a esa página');
        }
        return $next($request);
    }
}
