<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\SurveyResponseController;


Route::middleware(['auth:web', 'PreventBackHistory', 'is_employee'])->group(function () {
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::resource('survey-responses', SurveyResponseController::class);
    });
});
