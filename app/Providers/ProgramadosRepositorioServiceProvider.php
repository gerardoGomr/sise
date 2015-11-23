<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Graficas\ProgramadosRepositorioLaravelSQLServer;

class ProgramadosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Graficas\ProgramadosRepositorioInterface', function($app) {
            return new ProgramadosRepositorioLaravelSQLServer();
        });
    }
}
