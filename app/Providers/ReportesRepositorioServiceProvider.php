<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Archivo\ReportesRepositorioLaravelSQLServer;

class ReportesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Archivo\ReportesRepositorioInterface', function($app) {
            return new ReportesRepositorioLaravelSQLServer();
        });
    }
}
