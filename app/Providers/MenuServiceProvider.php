<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view) {
            $verticalMenuData = $horizontalMenuData = [];
            $user = Auth::user();

            if(isset($user)){
                // Menús
                $verticalMenuData = json_decode(file_get_contents(base_path("resources/data/menu-data/$user->tipo/verticalMenu.json")));
                $horizontalMenuData = json_decode(file_get_contents(base_path("resources/data/menu-data/$user->tipo/horizontalMenu.json")));
            }
            $view->with('menuData', [$verticalMenuData, $horizontalMenuData]);
        });

    }
}
