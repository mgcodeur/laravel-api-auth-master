<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\Models;

use Mgcodeur\LaravelApiAuthMaster\Traits\ModelHelpers\AuthMasterOtpTrait;

trait AuthMasterTrait
{
    use AuthMasterOtpTrait;

    public function setPasswordAttribute($value): void
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
}
