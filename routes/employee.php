<?php

use App\Models\SurveyForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\SurveyResponseController;


Route::middleware(['auth:web', 'PreventBackHistory', 'is_employee'])->group(function () {
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('survey-responses', [SurveyResponseController::class, 'index'])->name('survey-responses.index');
        Route::get('survey-responses/create/{surveyForm}', [SurveyResponseController::class, 'create'])->name('survey-responses.create');
        Route::post('survey-responses', [SurveyResponseController::class, 'store'])->name('survey-responses.store');
    });
});
