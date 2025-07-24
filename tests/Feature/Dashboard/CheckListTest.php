<?php

declare(strict_types=1);

use App\Livewire\Dashboard\CheckList;
use App\Models\Organization;
use App\Models\User;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

test('checklist component renders correctly', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->livewire(CheckList::class)
        ->assertStatus(200);
});

test('checklist calculates progress correctly when no organization exists', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->livewire(CheckList::class)
        ->assertSet('totalSteps', 4)
        ->assertSet('completedSteps', 0)
        ->assertSet('percentComplete', 0);
});

test('checklist calculates progress correctly when organization exists', function () {
    $user = User::factory()->create();
    Organization::factory()->create();

    $this->actingAs($user)
        ->livewire(CheckList::class)
        ->assertSet('totalSteps', 4)
        ->assertSet('completedSteps', 1)
        ->assertSet('percentComplete', 25);
});

test('skip setup marks organization as completed', function () {
    $user = User::factory()->create();
    $organization = Organization::factory()->create(['checklist_completed' => false]);

    $this->actingAs($user)
        ->livewire(CheckList::class)
        ->call('skipSetup');

    expect($organization->fresh()->checklist_completed)->toBeTruthy();
});

test('skip setup handles null organization gracefully', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->livewire(CheckList::class)
        ->call('skipSetup');

    // Should not throw an error
    expect(true)->toBeTrue();
});
