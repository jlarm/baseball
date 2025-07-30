<?php

declare(strict_types=1);

use App\Http\Requests\OrganizationRequest;

test('organization request has correct rules', function () {
    $request = new OrganizationRequest();

    $rules = $request->rules();

    expect($rules)->toHaveKey('uuid');
    expect($rules)->toHaveKey('name');
    expect($rules)->toHaveKey('logo_path');
    expect($rules)->toHaveKey('address');
    expect($rules)->toHaveKey('city');
    expect($rules)->toHaveKey('state');
    expect($rules)->toHaveKey('phone');
    expect($rules)->toHaveKey('email');

    expect($rules['uuid'])->toContain('required');
    expect($rules['name'])->toContain('required');
    expect($rules['email'])->toContain('email');
    expect($rules['email'])->toContain('max:254');
});

test('organization request is always authorized', function () {
    $request = new OrganizationRequest();

    expect($request->authorize())->toBeTrue();
});
