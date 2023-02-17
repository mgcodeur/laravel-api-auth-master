<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->name('api.')->group(function () {
    require __DIR__.'/api/auth.php';
});
