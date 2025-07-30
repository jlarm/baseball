<?php

declare(strict_types=1);

use App\Livewire\Division\Index;
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
        ->test(Index::class)
        ->assertStatus(200)
        ->assertViewIs('livewire.division.index');
});

it('displays divisions from current season ordered by name', function () {
    Division::factory()->create(['name' => 'Charlie Division', 'season_id' => $this->season->id]);
    Division::factory()->create(['name' => 'Alpha Division', 'season_id' => $this->season->id]);
    Division::factory()->create(['name' => 'Beta Division', 'season_id' => $this->season->id]);

    // Create divisions for different season to ensure they're not included
    $otherSeason = Season::factory()->create();
    Division::factory()->create(['name' => 'Other Season Division', 'season_id' => $otherSeason->id]);

    $component = Livewire::actingAs($this->user)->test(Index::class);
    $divisions = $component->viewData('divisions');

    expect($divisions->count())->toBe(3)
        ->and($divisions->pluck('name')->toArray())->toBe([
            'Alpha Division',
            'Beta Division',
            'Charlie Division',
        ]);
});

it('handles no current season gracefully', function () {
    // Clear season to simulate no current season
    Season::query()->delete();
    app(SeasonService::class)->clearCache();

    Livewire::actingAs($this->user)
        ->test(Index::class)
        ->assertStatus(200);
});

it('deletes division and dispatches event', function () {
    $division = Division::factory()->create(['season_id' => $this->season->id]);

    Livewire::actingAs($this->user)
        ->test(Index::class)
        ->call('delete', $division->id)
        ->assertDispatched('division.deleted');

    expect(Division::find($division->id))->toBeNull();
});

it('handles deleting non-existent division gracefully', function () {
    Livewire::actingAs($this->user)
        ->test(Index::class)
        ->call('delete', 999)
        ->assertDispatched('division.deleted');
});

it('refreshes on division-created event', function () {
    $component = Livewire::actingAs($this->user)->test(Index::class);

    // Create division after component is rendered
    Division::factory()->create(['name' => 'New Division', 'season_id' => $this->season->id]);

    // Dispatch the event that should trigger refresh
    $component->dispatch('division-created');

    $divisions = $component->viewData('divisions');
    expect($divisions->count())->toBe(1)
        ->and($divisions->first()->name)->toBe('New Division');
});

it('refreshes on division-deleted event', function () {
    $division = Division::factory()->create(['season_id' => $this->season->id]);

    $component = Livewire::actingAs($this->user)->test(Index::class);
    expect($component->viewData('divisions')->count())->toBe(1);

    // Delete division and dispatch event
    $division->delete();
    $component->dispatch('division-deleted');

    expect($component->viewData('divisions')->count())->toBe(0);
});

it('has correct title', function () {
    Livewire::actingAs($this->user)
        ->test(Index::class)
        ->assertSee('Divisions');
});
