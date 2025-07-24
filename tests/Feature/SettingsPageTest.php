<?php

declare(strict_types=1);

use App\Livewire\SettingsPage;
use App\Models\Organization;
use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('settings page renders correctly', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->assertStatus(200);
});

test('settings page loads organization data when exists', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create([
        'name' => 'Test Organization',
        'address' => '123 Test St',
        'city' => 'Test City',
    ]);

    $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->assertSet('name', 'Test Organization')
        ->assertSet('address', '123 Test St')
        ->assertSet('city', 'Test City');
});

test('settings page handles null organization', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->assertSet('name', '')
        ->assertSet('address', '')
        ->assertSet('city', '');
});
