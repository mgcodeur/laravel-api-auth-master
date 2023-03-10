<?php

namespace Mgcodeur\LaravelApiAuthMaster\Commands;

use Illuminate\Console\Command;

class LaravelApiAuthMasterCommand extends Command
{
    public $signature = 'mg-auth:install';

    public $description = 'Install Laravel Api Auth Master package';

    public function handle(): int
    {
        $this->call('vendor:publish', ['--tag' => 'mg-auth-config']);
        $this->call('vendor:publish', ['--tag' => 'mg-auth-migrations']);
        $this->call('vendor:publish', ['--provider' => 'L5Swagger\L5SwaggerServiceProvider']);

        return self::SUCCESS;
    }
}
