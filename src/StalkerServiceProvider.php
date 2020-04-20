<?php

namespace Theomessin\Stalker;

use Illuminate\Support\ServiceProvider;
use Theomessin\Stalker\Http\Middleware\StalkRequests;

class StalkerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConsole();
        $this->bootMiddleware();
    }

    /**
     * Console specific booting.
     */
    protected function bootConsole()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrations();
        }
    }

    /**
     * Publish the package migrations.
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Define stalk middleware.
     */
    protected function bootMiddleware()
    {
        app('router')->aliasMiddleware('stalk', StalkRequests::class);
    }
}
