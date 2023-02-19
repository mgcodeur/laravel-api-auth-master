<?php

namespace Mgcodeur\LaravelApiAuthMaster\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMaster
 */
class LaravelApiAuthMaster extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMaster::class;
    }
}
