<?php

namespace Mgcodeur\LaravelApiAuthMaster\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;
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

    protected function getPackageProviders($app): array
    {
        return [
            LaravelApiAuthMasterServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        $migrations = array_map(fn ($file) => include $file, glob(__DIR__.'/../database/migrations/*.php'));
        foreach ($migrations as $migration) {
            $migration->up();
        }
    }
}
