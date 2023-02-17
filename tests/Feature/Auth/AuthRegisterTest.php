<?php

test('The register route is defined', function () {
    $this->assertTrue(Illuminate\Support\Facades\Route::has('api.auth.register'));
});

it('Validate input datas', function () {
    $response = $this->postJson(route('api.auth.register'), []);
    $response->assertStatus(400);
    $response->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'password']);
});

//TODO: store user in database
