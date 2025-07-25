<?php

declare(strict_types=1);

use App\Livewire\SettingsPage;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        ->assertSet('form.name', 'Test Organization')
        ->assertSet('form.address', '123 Test St')
        ->assertSet('form.city', 'Test City');
});

test('settings page handles null organization', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->assertSet('form.name', '')
        ->assertSet('form.address', '')
        ->assertSet('form.city', '');
});

test('settings page can create organization', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->set('form.name', 'New Organization')
        ->set('form.address', '456 New St')
        ->set('form.city', 'New City')
        ->set('form.state', 'CA')
        ->call('createOrUpdate')
        ->assertHasNoErrors();

    $organization = Organization::first();
    expect($organization->name)->toBe('New Organization');
    expect($organization->address)->toBe('456 New St');
    expect($organization->city)->toBe('New City');
    expect($organization->state->value)->toBe('CA');
});

test('settings page can update existing organization', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create([
        'name' => 'Original Name',
        'address' => 'Original Address',
    ]);

    $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->set('form.name', 'Updated Name')
        ->set('form.address', 'Updated Address')
        ->call('createOrUpdate')
        ->assertHasNoErrors();

    $organization->refresh();
    expect($organization->name)->toBe('Updated Name');
    expect($organization->address)->toBe('Updated Address');
});

test('settings page can upload logo', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('logo.png', 100, 100);

    $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->set('form.name', 'Test Organization')
        ->set('form.logo', $file)
        ->call('createOrUpdate')
        ->assertHasNoErrors();

    $organization = Organization::first();
    expect($organization->logo_path)->not->toBeNull();
    Storage::disk('public')->assertExists($organization->logo_path);
});

test('settings page shows temporary image url during upload', function () {
    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('logo.png', 100, 100);

    $component = $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->set('form.logo', $file);

    expect($component->get('temporaryImageUrl'))->not->toBeNull();
});

test('settings page can remove logo', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $organization = Organization::factory()->create([
        'logo_path' => 'logos/test-logo.png',
    ]);

    $this->actingAs($user)
        ->livewire(SettingsPage::class)
        ->call('removeLogo')
        ->assertSet('form.logoPath', '');
});
