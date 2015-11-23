<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Usuarios\TrabajadoresRepositorioLaravelSQLServer;

class TrabajadoresRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Usuarios\TrabajadoresRepositorioInterface', function($app) {
            return new TrabajadoresRepositorioLaravelSQLServer();
        });
    }
}
