<?php

namespace Sise\Providers;

use Illuminate\Support\ServiceProvider;
use Sise\Catalogos\CatalogoRepositorioLaravelSQLServer;

class CatalogoRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Sise\Catalogos\CatalogoRepositorioInterface', function($app) {
            return new CatalogoRepositorioLaravelSQLServer();
        });
    }
}
