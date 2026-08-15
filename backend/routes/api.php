<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\ReportsController;

Route::get('/status', function () {
    return ['status' => 'ok'];
});

Route::prefix('api')->group(function () {
    // Basic placeholder API endpoints
    Route::get('/products', fn() => ['data' => []]);

    // Settings API
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::post('/settings', [SettingsController::class, 'update']);

    // Reports
    Route::get('/reports/daybook', [ReportsController::class, 'dayBook']);
    Route::get('/reports/pnl', [ReportsController::class, 'profitLoss']);
});
