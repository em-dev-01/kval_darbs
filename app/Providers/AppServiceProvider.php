<?php

namespace App\Providers;

use App\Models\ClientRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.navigation', function ($view) {
            $unreadCount = ClientRequest::where('read_status', false)->count();
            $view->with('unreadCount', $unreadCount);
        });
    }
}
