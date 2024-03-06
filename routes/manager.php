<?php

use Illuminate\Support\Facades\Route;

Route::prefix('manager')->name('manager.')->group(function () {
    Route::resource('users', UserController::class);
});
