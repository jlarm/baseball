<?php

declare(strict_types=1);

use App\Livewire\Division\CreateModal;
use App\Models\Division;
use App\Models\Season;
use App\Models\User;
use App\Services\SeasonService;
use Livewire\Livewire;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->season = Season::factory()->active()->create();
    app(SeasonService::class)->clearCache();
});

it('renders correctly', function () {
    Livewire::actingAs($this->user)
        ->test(CreateModal::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.division.create-modal');
});

it('creates division with valid data', function () {
    Livewire::actingAs($this->user)
        ->test(CreateModal::class)
        ->set('name', 'Test Division')
        ->call('createDivision')
        ->assertHasNoErrors()
        ->assertSet('name', '')
        ->assertDispatched('division-created');

    expect(Division::where('name', 'Test Division')->first())
        ->not->toBeNull()
        ->and(Division::where('name', 'Test Division')->first()->season_id)
        ->toBe($this->season->id);
});

it('validates form has validation rules', function () {
    // Test that the form has validation attributes set up
    $component = Livewire::actingAs($this->user)->test(CreateModal::class);

    // Verify the validation rules are defined on the property
    $reflection = new ReflectionClass(CreateModal::class);
    $property = $reflection->getProperty('name');
    $attributes = $property->getAttributes();

    expect($attributes)->not->toBeEmpty();
});

it('resets form after successful creation', function () {
    $component = Livewire::actingAs($this->user)->test(CreateModal::class);

    $component
        ->set('name', 'Test Division')
        ->call('createDivision')
        ->assertSet('name', '');
});

it('cancels form and resets name', function () {
    Livewire::actingAs($this->user)
        ->test(CreateModal::class)
        ->set('name', 'Some Division')
        ->call('cancel')
        ->assertSet('name', '');
});

it('handles no current season gracefully', function () {
    // Clear season to simulate no current season
    Season::query()->delete();
    app(SeasonService::class)->clearCache();

    // This should not throw an error even without current season
    Livewire::actingAs($this->user)
        ->test(CreateModal::class)
        ->set('name', 'Test Division')
        ->call('createDivision');

    // No division should be created without a current season
    expect(Division::count())->toBe(0);
});
