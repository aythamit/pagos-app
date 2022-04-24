<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $version = env('APP_VERSION', '1.1');
        $auth_user = \auth()->user();

        view()->composer('*', function ($view) use ($version,$auth_user) {
            $view->with('APP_VERSION', $version)
                ->with('auth_user', $auth_user);

        });
    }
}
