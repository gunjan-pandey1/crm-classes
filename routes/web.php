<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('auth/login');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('crmPages/dashboard');
    })->name('dashboard');

    Route::get('leads', function () {
        return Inertia::render('crmPages/leads');
    })->name('leads');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
