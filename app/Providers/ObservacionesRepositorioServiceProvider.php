<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Infraestructura\Observaciones\ObservacionesRepositorioLaravelSQLServer;

class ObservacionesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Infraestructura\Observaciones\ObservacionesRepositorioInterface', function($app) {
            return new ObservacionesRepositorioLaravelSQLServer();
        });
    }
}
