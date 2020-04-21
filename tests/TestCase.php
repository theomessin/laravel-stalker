<?php

namespace Theomessin\Stalker\Tests;

use Illuminate\Foundation\Auth\User;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Theomessin\Stalker\StalkerServiceProvider;

class TestCase extends BaseTestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Migrate the in memory database.
        $this->artisan('migrate:fresh')->run();

        // Load default Laravel migrations (eg. users).
        $this->loadLaravelMigrations();

        // Use our own factories for models.
        $this->withFactories(__DIR__.'/../database/factories');

        // Create a default user for all requests.
        $this->user = factory(User::class)->create();

        // Create a some test routes.
        $this->registerTestingRoutes();
    }

    protected function getPackageProviders($app)
    {
        return [StalkerServiceProvider::class];
    }

    protected function registerTestingRoutes()
    {
        app('router')->any('/login', function () {
            return 'This is a login page.';
        })->middleware('guest')->name('login');

        app('router')->any('/unprotected', function () {
            return 'Hello world!';
        })->middleware('stalk');

        app('router')->any('/protected', function () {
            return 'Hello secret world!';
        })->middleware('stalk')->middleware('auth');
    }
}
