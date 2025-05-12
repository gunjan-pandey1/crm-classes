<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crm\LeadsController;

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

Route::post('leadsapi', [LeadsController::class, 'leadsprocess']);
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
