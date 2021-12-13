<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteMacroServiceProvider extends ServiceProvider
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
        Route::macro(
            'getGroupName',
            function () {
                return Route::current()->action['groupName'] ?? null;
            }
        );

        Route::macro(
            'groupName',
            function ($groupName) {
                $router = app(static::class);
                $lastGroupStackIndex = count($router->getGroupStack()) - 1;
                $router->groupStack[$lastGroupStackIndex]['groupName'] = $groupName;

                return $router;
            }
        );
    }
}
