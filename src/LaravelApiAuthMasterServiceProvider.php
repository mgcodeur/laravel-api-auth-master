<?php

namespace Mgcodeur\LaravelApiAuthMaster;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mgcodeur\LaravelApiAuthMaster\Commands\LaravelApiAuthMasterCommand;

class LaravelApiAuthMasterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('mg-auth')
            ->hasConfigFile(['api-auth-master'])
            ->hasMigrations(['customize_users_table'])
            ->hasViews()
            ->hasRoute('api')
            ->hasCommand(LaravelApiAuthMasterCommand::class);
    }
}
