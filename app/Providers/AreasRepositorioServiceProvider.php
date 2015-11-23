<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Usuarios\AreasRepositorioLaravelSQLServer;

class AreasRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Usuarios\AreasRepositorioInterface', function($app) {
            return new AreasRepositorioLaravelSQLServer();
        });
    }
}
