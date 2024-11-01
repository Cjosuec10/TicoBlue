<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;

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
        // Comparte las notificaciones no leídas en todas las vistas
        view()->composer('*', function ($view) {
            $notifications = Notification::where('is_read', false)->get();
            $view->with('notifications', $notifications);
        });
    }
}
