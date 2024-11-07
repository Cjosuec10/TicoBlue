<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Verificar si el usuario está autenticado
    if (Auth::check()) {
        // Compartir las notificaciones no leídas del usuario autenticado
        View::share('unreadNotifications', Auth::user()->unreadNotifications);
    } else {
        // Si no está autenticado, comparte una colección vacía
        View::share('unreadNotifications', collect());
    }

    // Otra opción para compartir notificaciones no leídas en todas las vistas
    view()->composer('*', function ($view) {
        // Aquí puedes personalizar la consulta de notificaciones si lo necesitas
        $notifications = Notification::where('is_read', false)->get();
        $view->with('notifications', $notifications);
    });
}
}
