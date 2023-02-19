<?php

namespace Mgcodeur\LaravelApiAuthMaster\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMasterServiceProvider;
use Mgcodeur\LaravelApiAuthMaster\Traits\Configurations\TestEnvironmentConfigurationTrait;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use TestEnvironmentConfigurationTrait;

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
        $this->runPackageMigrations();
    }
}
