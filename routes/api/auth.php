<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', Mgcodeur\LaravelApiAuthMaster\Http\Controllers\Auth\AuthRegisterController::class)->name('register');
    Route::post('login', Mgcodeur\LaravelApiAuthMaster\Http\Controllers\Auth\AuthLoginController::class)->name('login');

    Route::name('socialite.')->group(function () {
        Route::get('{provider}', Mgcodeur\LaravelApiAuthMaster\Http\Controllers\AuthSocialite\AuthSocialiteRedirectController::class)->name('redirect');
        Route::get('{provider}/callback', Mgcodeur\LaravelApiAuthMaster\Http\Controllers\AuthSocialite\AuthSocialiteCallbackController::class)->name('callback');
    });
});
