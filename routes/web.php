<?php

declare(strict_types=1);

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', App\Livewire\Dashboard\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('organization-settings', App\Livewire\SettingsPage::class)
    ->middleware(['auth', 'verified'])
    ->name('org.settings');

Route::get('divisions', App\Livewire\Division\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('divisions.index');

Route::get('divisions/{division}', App\Livewire\Division\Show::class)
    ->middleware(['auth', 'verified'])
    ->name('divisions.show');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
