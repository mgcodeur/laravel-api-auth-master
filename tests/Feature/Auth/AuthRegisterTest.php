<?php

use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertTrue;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('The register route is defined', function () {
    assertTrue(Illuminate\Support\Facades\Route::has('api.auth.register'));
});

it('Validate input datas', function () {
    $response = postJson(route('api.auth.register'), []);
    $response->assertStatus(400);
    $response->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'password']);
});

it('Store a new user', function () {
    $response = postJson(route('api.auth.register'), [
        'first_name' => fake()->firstName,
        'last_name' => fake()->lastName,
        'email' => fake()->unique()->safeEmail,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);
    $response->assertStatus(201);

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
    ]);

    $response->assertJsonFragment([
        'access_token' => $response->json('data.access_token'),
    ]);
});
