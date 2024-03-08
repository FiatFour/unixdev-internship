<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\EmployeeController;

Route::prefix('manager')->name('manager.')->group(function () {
    Route::get('users', [EmployeeController::class, 'index']);
});
