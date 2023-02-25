<?php

namespace Mgcodeur\LaravelApiAuthMaster\Traits\FakerForTests;

class DevUserForTests
{
    public static function generateFakeUser()
    {
        $faker = \Faker\Factory::create('Fr_fr');

        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    }

    public static function wrongCredentials()
    {
        $user = self::generateFakeUser();

        return [
            'email' => $user['email'],
            'password' => 'wrong_password',
        ];
    }
}
