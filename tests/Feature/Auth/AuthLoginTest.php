<?php

use Mgcodeur\LaravelApiAuthMaster\Traits\FakerForTests\DevUserForTests;
use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertTrue;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('Test the login route', function () {
    // Check if the login route exists
    assertTrue(Illuminate\Support\Facades\Route::has('api.auth.login'));
});

it('Validate the login form', function () {
    // Check if the login form is validated
    postJson(route('api.auth.login'), [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
});

it('Can\'t login with wrong credentials', function () {
    // Check if the login form is validated
    postJson(route('api.auth.login'), DevUserForTests::wrongCredentials())
        ->assertUnauthorized();
});

it('Login with correct credentials', function () {
    //Create a new user
    $user = DevUserForTests::generateFakeUser();
    postJson(route('api.auth.register'), $user);

    //Login with the new user
    postJson(route('api.auth.login'), [
        'email' => $user['email'],
        'password' => $user['password'],
    ])->assertOk();
});

it('Provide access token', function () {
    //Create a new user
    $user = DevUserForTests::generateFakeUser();
    postJson(route('api.auth.register'), $user);

    //Login with the new user
    $response = postJson(route('api.auth.login'), [
        'email' => $user['email'],
        'password' => $user['password'],
    ]);

    //Check if the access token is present
    $response->assertJsonFragment([
        'access_token' => $response->json('data.access_token'),
    ]);
});

test('Success message is good', function () {
    $user = DevUserForTests::generateFakeUser();
    postJson(route('api.auth.register'), $user);

    $response = postJson(route('api.auth.login'), [
        'email' => $user['email'],
        'password' => $user['password'],
    ]);

    // Check if the success message is good
    $response->assertJsonFragment([
        'message' => trans('mg-auth::auth.login.success.message'),
    ]);
});

test('Error message is good', function () {
    $response = postJson(route('api.auth.login'), DevUserForTests::wrongCredentials());
    $response->assertJsonFragment([
        'message' => trans('mg-auth::auth.login.error.message'),
    ]);
});

test('Verify sanctum token format', function () {
    $user = DevUserForTests::generateFakeUser();
    postJson(route('api.auth.register'), $user);

    $response = postJson(route('api.auth.login'), [
        'email' => $user['email'],
        'password' => $user['password'],
    ]);

    // Check if the token is valid
    assertTrue(\Laravel\Sanctum\PersonalAccessToken::findToken($response->json('data.access_token'))->exists);
});
