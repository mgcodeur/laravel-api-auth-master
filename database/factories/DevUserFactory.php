<?php

namespace Mgcodeur\LaravelApiAuthMaster\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Mgcodeur\LaravelApiAuthMaster\Models\DevUser>
 */
class DevUserFactory extends Factory
{
    protected $faker;

    protected $model = \Mgcodeur\LaravelApiAuthMaster\Models\DevUser::class;

    public function __construct()
    {
        parent::__construct();
        $this->faker = \Faker\Factory::create('fr_FR');
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
