<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\ModelHelpers;

trait OTPHelpers
{
    public function generateOtpCode()
    {
        $length = config('api-auth-master.otp.length');

        return random_int(pow(10, $length - 1), pow(10, $length) - 1);
    }
}
