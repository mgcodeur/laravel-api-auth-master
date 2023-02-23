<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\Models;
use Mgcodeur\LaravelApiAuthMaster\Traits\ModelHelpers\AuthMasterOtpTrait;

trait AuthMasterTrait
{
    use AuthMasterOtpTrait;

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
