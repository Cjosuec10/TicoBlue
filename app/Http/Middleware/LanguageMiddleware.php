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

        // Lista de idiomas soportados
        $supportedLocales = ['es', 'en']; // agrega otros idiomas según sea necesario

        // Verificar si el idioma es soportado
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('app.locale'); // revertir al idioma por defecto
        }

        // Configurar el idioma de la aplicación
        App::setLocale($locale);

        return $next($request);
    }
}
