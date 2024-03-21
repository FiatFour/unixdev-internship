<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\SurveyFormController;

Route::middleware(['auth:web', 'PreventBackHistory', 'is_manager'])->group(function () {
    Route::prefix('manager')->name('manager.')->group(function () {
//    Route::get('users', [EmployeeController::class, 'index']);
        Route::resource('survey-forms', SurveyFormController::class);
//        Route::get('survey-forms/index', [SurveyFormController::class, 'index'])->name('survey-forms.index');
    });
});
