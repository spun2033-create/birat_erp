<?php

use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return ['status' => 'ok'];
});

Route::prefix('api')->group(function () {
    // Placeholder API endpoints
    Route::get('/products', fn() => ['data' => []]);
    Route::get('/settings', fn() => ['data' => []]);
});
