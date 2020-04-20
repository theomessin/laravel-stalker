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

        // Create a test stalked route.
        app('router')->any('stalked', null)->middleware('stalk');
    }

    protected function getPackageProviders($app)
    {
        return [StalkerServiceProvider::class];
    }
}
