<?php

use Illuminate\Support\Facades\Route;
use Softnio\UtilityServices\Controllers\UtilityServiceController;

    Route::get('apps/superadmin', [UtilityServiceController::class, 'allowSetup'])->name('app.service.setup');
    Route::post('apps/activate', [UtilityServiceController::class, 'validService'])->name('app.service.update');
