<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth:web', 'is_admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });
});
