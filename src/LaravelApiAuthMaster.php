<?php

namespace Mgcodeur\LaravelApiAuthMaster;

class LaravelApiAuthMaster
{
    /**
     * Get the auth model
     */
    public static function getAuthModel(): mixed
    {
        $class = config('api-auth-master.auth.model');

        return class_exists($class) ? $class : \Mgcodeur\LaravelApiAuthMaster\Models\DevUser::class;
    }

    public static function getTable(): string
    {
        return config('api-auth-master.auth.table');
    }
}
