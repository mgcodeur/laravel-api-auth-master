<?php

use Illuminate\Support\Facades\Hash;
use Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMaster;
use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertTrue;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('Test the register route', function () {
    // Check if the register route exists
    assertTrue(Illuminate\Support\Facades\Route::has('api.auth.register'));
});

it('Validate input datas', function () {
    // Test the validation
    $response = postJson(route('api.auth.register'), []);

    // Verify the response status
    $response->assertStatus(400);

    // Validations errors
    $response->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'password']);
});

it('Store a new user', function () {
    // Create a new user
    $response = postJson(route('api.auth.register'), [
        'first_name' => fake()->firstName,
        'last_name' => fake()->lastName,
        'email' => fake()->unique()->safeEmail,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    // Verify the response status
    $response->assertStatus(201);

    // Verify the response structure
    $response->assertJsonStructure([
        'data' => [
            'id',
            'first_name',
            'last_name',
            'email',
            'access_token',
            'created_at',
            'updated_at',
        ],
        'message',
    ]);

    // Verify if response data contains the access_token
    $response->assertJsonFragment([
        'access_token' => $response->json('data.access_token'),
    ]);

    // Verify the message
    $response->assertJsonFragment([
        'message' => trans('mg-auth::auth.register.success.message'),
    ]);

    // Check if the password is hashed
    $user = LaravelApiAuthMaster::getAuthModel()::where('email', $response->json('data.email'))->first();
    assertTrue(Hash::check('password', $user->password));
});
