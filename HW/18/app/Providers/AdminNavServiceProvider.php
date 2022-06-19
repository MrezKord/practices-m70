<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminNavServiceProvider extends ServiceProvider
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
        View::composer('adminHeader', function ($view) {
            $view->with('items', [
                '/reserve' => 'Home',
                '/user' => 'Users',
                '/user/showReserves' => 'Reserves',
                '/user/Services' => 'Services',
            ]);
        });
    }
}
