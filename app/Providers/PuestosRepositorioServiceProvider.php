<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Usuarios\PuestosRepositorioLaravelSQLServer;

class PuestosRepositorioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Sise\Usuarios\PuestosRepositorioInterface', function($app) {
            return new PuestosRepositorioLaravelSQLServer();
        });
    }
}
