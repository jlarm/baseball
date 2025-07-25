<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Organization;
use App\Services\OrganizationService;
use Str;

final class OrganizationObserver
{
    public function creating(Organization $organization): void
    {
        $organization->uuid = (string) Str::uuid();
    }

    public function saved(Organization $organization): void
    {
        app(OrganizationService::class)->clearCache();
    }

    public function deleted(Organization $organization): void
    {
        app(OrganizationService::class)->clearCache();
    }
}
