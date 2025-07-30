<?php

declare(strict_types=1);

use App\Enums\Status;

test('status enum has correct values', function () {
    expect(Status::ACTIVE->value)->toBe('active');
    expect(Status::ARCHIVED->value)->toBe('archived');
});

test('status enum has correct labels', function () {
    expect(Status::ACTIVE->label())->toBe('Active');
    expect(Status::ARCHIVED->label())->toBe('Archived');
});
