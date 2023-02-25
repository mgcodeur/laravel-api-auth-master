<?php

use Illuminate\Support\Facades\Hash;
use Mgcodeur\LaravelApiAuthMaster\LaravelApiAuthMaster;
use Mgcodeur\LaravelApiAuthMaster\Traits\FakerForTests\DevUserForTests;
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
    $response->assertStatus(422);

    // Validations errors
    $response->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'password']);
});

it('Store a new user', function () {
    // Create a new user
    $response = postJson(route('api.auth.register'), DevUserForTests::generateFakeUser());

    // Verify the response status
    $response->assertStatus(201);
});

it('Hash the password', function () {
    // Create a new user
    $response = postJson(route('api.auth.register'), DevUserForTests::generateFakeUser());

    // Check if the password is hashed
    $user = LaravelApiAuthMaster::getAuthModel()::where('email', $response->json('data.email'))->first();
    assertTrue(Hash::check('password', $user->password));
});

it('Provides access token', function () {
    // Create a new user
    $response = postJson(route('api.auth.register'), DevUserForTests::generateFakeUser());

    // Check if the access token is present
    $response->assertJsonFragment([
        'access_token' => $response->json('data.access_token'),
    ]);
});

it('Has a success message', function () {
    $response = postJson(route('api.auth.register'), DevUserForTests::generateFakeUser());

    // Check if the success message is present
    $response->assertJsonFragment([
        'message' => trans('mg-auth::auth.register.success.message'),
    ]);
});

it('Return the good datas', function () {
    // Create a new user
    $response = postJson(route('api.auth.register'), DevUserForTests::generateFakeUser());

    // Check if the user datas are present
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
});

it('Token has the good name', function () {
    // Create a new user
    $response = postJson(route('api.auth.register'), DevUserForTests::generateFakeUser());

    // Check if the token name is the good one
    $user = LaravelApiAuthMaster::getAuthModel()::where('email', $response->json('data.email'))->first();
    assertTrue($user->tokens->first()->name === config('api-auth-master.token.name'));
});

test('User is not verfied yet', function () {
    // Create a new user
    $response = postJson(route('api.auth.register'), DevUserForTests::generateFakeUser());

    // Check if the user is not verified
    $user = LaravelApiAuthMaster::getAuthModel()::where('email', $response->json('data.email'))->first();
    assertTrue($user->email_verified_at === null);
});
