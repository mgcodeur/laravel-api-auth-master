<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\Models;

trait AuthMasterTrait
{
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
