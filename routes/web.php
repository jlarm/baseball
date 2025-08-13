<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('organization-settings', [OrganizationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('organization-settings');

Route::post('organization', [OrganizationController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('organization.store');

Route::put('organization', [OrganizationController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('organization.update');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
