<?php

namespace Mgcodeur\LaravelApiAuthMaster;

use Mgcodeur\LaravelApiAuthMaster\Commands\LaravelApiAuthMasterCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigrations([
                'mg_auth_01_customize_users_table',
                'mg_auth_02_create_social_accounts_table',
            ])
            ->hasViews()
            ->hasRoute('api')
            ->hasCommand(LaravelApiAuthMasterCommand::class)
            ->hasTranslations();
    }
}
