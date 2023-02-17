<?php

namespace Mgcodeur\LaravelApiAuthMaster\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMasterServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Mgcodeur\\LaravelApiAuthMaster\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelApiAuthMasterServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-api-auth-master_table.php.stub';
        $migration->up();
        */
    }
}
