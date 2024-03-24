<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\SurveyFormController;
use App\Http\Controllers\Manager\ReportController;

Route::middleware(['auth:web', 'PreventBackHistory', 'is_manager'])->group(function () {
    Route::prefix('manager')->name('manager.')->group(function () {
        Route::post('survey-reports/get-data', [ReportController::class, 'getData'])->name('survey-reports.get-data');
        Route::get('survey-reports/data-only', [ReportController::class, 'dataOnly'])->name('survey-reports.data-only');
        Route::resource('survey-forms', SurveyFormController::class);
    });
});
