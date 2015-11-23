<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Graficas\EvaluadosRepositorioLaravelSQLServer;

class EvaluadosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Graficas\EvaluadosRepositorioInterface', function($app) {
            return new EvaluadosRepositorioLaravelSQLServer();
        });
    }
}
