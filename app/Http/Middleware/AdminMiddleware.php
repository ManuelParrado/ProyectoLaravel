<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario está autenticado y tiene el rol de admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Si el usuario no tiene el rol de admin, puedes redirigirlo a alguna página o realizar otra acción.
        return redirect()->route('expense.index')->with('error', 'You dont have permission.');
    }
}
