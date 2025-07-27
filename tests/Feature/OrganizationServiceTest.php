<?php

declare(strict_types=1);

use App\Models\Organization;
use App\Models\User;
use App\Services\OrganizationService;
use Illuminate\Support\Facades\Cache;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('organization service returns current organization', function () {
    $organization = Organization::factory()->create(['name' => 'Test Org']);

    $service = app(OrganizationService::class);

    expect($service->current()->name)->toBe('Test Org');
});

test('organization service returns app name when no organization exists', function () {
    $service = app(OrganizationService::class);
    $service->clearCache(); // Clear any cached organization data

    expect($service->name())->toBe(config('app.name'));
});

test('organization service returns organization name when exists', function () {
    Organization::factory()->create(['name' => 'My Organization']);

    $service = app(OrganizationService::class);

    expect($service->name())->toBe('My Organization');
});

test('organization service returns logo url when logo exists', function () {
    $organization = Organization::factory()->create(['logo_path' => 'logos/test.png']);

    $service = app(OrganizationService::class);

    expect($service->logoUrl())->toBe(asset('storage/logos/test.png'));
    expect($service->hasLogo())->toBeTrue();
});

test('organization service returns null when no logo', function () {
    Organization::factory()->create(['logo_path' => null]);

    $service = app(OrganizationService::class);

    expect($service->logoUrl())->toBeNull();
    expect($service->hasLogo())->toBeFalse();
});

test('organization service caches organization data', function () {
    Organization::factory()->create(['name' => 'Cached Org']);

    $service = app(OrganizationService::class);

    // First call should cache the data
    $service->current();

    // Verify cache is set
    expect(Cache::has('current_organization'))->toBeTrue();
});

test('organization cache is cleared when organization is updated', function () {
    $organization = Organization::factory()->create(['name' => 'Original Name']);

    $service = app(OrganizationService::class);

    // Cache the organization
    $service->current();
    expect(Cache::has('current_organization'))->toBeTrue();

    // Update the organization (should clear cache)
    $organization->update(['name' => 'Updated Name']);

    expect(Cache::has('current_organization'))->toBeFalse();
});

test('global helpers work correctly', function () {
    Organization::factory()->create([
        'name' => 'Helper Test Org',
        'logo_path' => 'logos/helper.png',
    ]);

    expect(organization_name())->toBe('Helper Test Org');
    expect(organization_logo())->toBe(asset('storage/logos/helper.png'));
    expect(organization())->toBeInstanceOf(OrganizationService::class);
});

test('global view data is available in livewire component', function () {
    $organization = Organization::factory()->create([
        'name' => 'View Test Org',
        'logo_path' => 'logos/view.png',
    ]);

    $user = User::factory()->create();

    $component = $this->actingAs($user)
        ->livewire(App\Livewire\SettingsPage::class);

    // The global view data should be accessible through the component
    expect($component->viewData('organizationName'))->toBe('View Test Org');
    expect($component->viewData('hasOrganizationLogo'))->toBeTrue();
});
