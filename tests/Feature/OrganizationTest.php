<?php

use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can render the organization settings form', function () {
    $response = $this->actingAs($this->user)->get('/organization-settings');

    $response->assertOk();
});

it('can create an organization', function () {
    $organizationData = [
        'name' => 'Test Organization',
        'address' => '123 Main St',
        'city' => 'Test City',
        'state' => 'Test State',
        'zip_code' => '12345',
    ];

    $response = $this->actingAs($this->user)
        ->post('/organization', $organizationData);

    $response->assertRedirect('/organization-settings');

    $this->assertDatabaseHas('organizations', $organizationData);
});

it('can update an organization', function () {
    $organization = Organization::factory()->create();

    $updateData = [
        'name' => 'Updated Organization',
        'address' => '456 Updated St',
        'city' => 'Updated City',
        'state' => 'Updated State',
        'zip_code' => '67890',
    ];

    $response = $this->actingAs($this->user)
        ->put('/organization', $updateData);

    $response->assertRedirect('/organization-settings');

    $this->assertDatabaseHas('organizations', $updateData);
});

it('validates required fields', function () {
    $response = $this->actingAs($this->user)
        ->post('/organization', []);

    $response->assertSessionHasErrors([
        'name',
        'address',
        'city',
        'state',
        'zip_code',
    ]);
});
