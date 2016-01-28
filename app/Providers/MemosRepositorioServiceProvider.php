<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Infraestructura\Evaluaciones\MemosRepositorioLaravelSQLServer;

class MemosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Infraestructura\Evaluaciones\MemosRepositorioInterface', function($app) {
           return new MemosRepositorioLaravelSQLServer();
        });
    }
}
