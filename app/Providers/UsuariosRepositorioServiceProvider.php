<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Infraestructura\Usuarios\UsuariosRepositorioLaravelSQLServer;

class UsuariosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Infraestructura\Usuarios\UsuariosRepositorioInterface', function($app) {
            return new UsuariosRepositorioLaravelSQLServer();
        });
    }
}
