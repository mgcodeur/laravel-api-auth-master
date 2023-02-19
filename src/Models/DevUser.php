<?php

namespace Mgcodeur\LaravelApiAuthMaster\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mgcodeur\LaravelApiAuthMaster\Database\Factories\UserFactory;

class DevUser extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
