<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si la ruta tiene el prefijo 'es', usar español
        if ($request->is('es*') || $request->segment(1) === 'es') {
            App::setLocale('es');
            Session::put('locale', 'es');
        } else {
            // Por defecto inglés
            App::setLocale('en');
            Session::put('locale', 'en');
        }

        return $next($request);
    }
}

