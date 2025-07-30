<?php

declare(strict_types=1);

use App\Models\Organization;
use App\Services\OrganizationService;
use App\Services\SeasonService;

test('organization helper returns organization service', function () {
    expect(organization())->toBeInstanceOf(OrganizationService::class);
});

test('season helper returns season service', function () {
    expect(season())->toBeInstanceOf(SeasonService::class);
});

test('organization_name helper returns name from service', function () {
    organization()->clearCache();
    Organization::factory()->create(['name' => 'Test Organization']);

    expect(organization_name())->toBe('Test Organization');
});

test('organization_name helper returns app name when no organization', function () {
    organization()->clearCache();
    expect(organization_name())->toBe(config('app.name', 'Baseball'));
});

test('organization_logo helper returns null when no organization', function () {
    organization()->clearCache();
    expect(organization_logo())->toBeNull();
});

test('organization_logo helper returns url when organization has logo', function () {
    organization()->clearCache();
    Organization::factory()->create(['logo_path' => 'test-logo.png']);

    expect(organization_logo())->toContain('storage/test-logo.png');
});

test('current_season helper returns null when no season', function () {
    season()->clearCache();
    expect(current_season())->toBeNull();
});

test('season_year helper returns current year when no season', function () {
    season()->clearCache();
    expect(season_year())->toBe(date('Y'));
});
