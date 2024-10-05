<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Obtener el idioma de la sesión, por defecto 'es'
        $locale = Session::get('locale', config('app.locale'));

        // Configurar el idioma de la aplicación
        App::setLocale($locale);

        return $next($request);
    }
}
