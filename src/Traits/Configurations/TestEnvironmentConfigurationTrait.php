<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\Configurations;

trait TestEnvironmentConfigurationTrait
{
    public function getAllMigrations(): array
    {
        return array_map(fn ($file) => include $file, glob(__DIR__.'/../../../database/migrations/*.php'));
    }

    public function runPackageMigrations(): void
    {
        foreach ($this->getAllMigrations() as $migration) {
            $migration->up();
        }
    }
}
