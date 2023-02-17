<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', Mgcodeur\LaravelApiAuthMaster\Http\Controllers\Auth\AuthRegisterController::class)->name('register');
});
