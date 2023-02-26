<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $table = 'social_accounts';

    protected $fillable = [
        'provider_name',
        'provider_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(config('api-auth-master.auth.model'));
    }
}
