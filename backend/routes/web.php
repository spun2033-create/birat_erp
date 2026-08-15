<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Public routes (placeholders; Breeze will generate auth routes when installed)
Route::get('/', function () {
    return Inertia::render('Welcome');
});

// Auth routes placeholder (will be provided by Breeze)
// Route::get('/login', ...);
// Route::post('/login', ...);

// Protected dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard/Index');
    })->name('dashboard');

    // Settings only admin
    Route::get('/dashboard/settings', function () {
        return Inertia::render('Dashboard/Settings');
    })->middleware('role:admin')->name('dashboard.settings');

    // Reports accessible to accountant and admin
    Route::get('/dashboard/reports', function () {
        return Inertia::render('Dashboard/Reports');
    })->middleware('role:admin,accountant')->name('dashboard.reports');
});
