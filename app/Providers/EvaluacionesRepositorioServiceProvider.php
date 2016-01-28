<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Infraestructura\Evaluaciones\EvaluacionesRepositorioLaravelSQLServer;

class EvaluacionesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Infraestructura\Evaluaciones\EvaluacionesRepositorioInterface', function ($app) {
           return new EvaluacionesRepositorioLaravelSQLServer();
        });
    }
}
