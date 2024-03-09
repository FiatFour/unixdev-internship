<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\UserController;

Route::middleware(['auth:web', 'PreventBackHistory', 'is_manager'])->group(function () {
    Route::prefix('manager')->name('manager.')->group(function () {
//    Route::get('users', [EmployeeController::class, 'index']);
        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });
});
