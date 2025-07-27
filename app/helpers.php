<?php

declare(strict_types=1);

use App\Services\OrganizationService;

if (! function_exists('organization')) {
    function organization(): OrganizationService
    {
        return app(OrganizationService::class);
    }
}

if (! function_exists('organization_name')) {
    function organization_name(): string
    {
        return organization()->name();
    }
}

if (! function_exists('organization_logo')) {
    function organization_logo(): ?string
    {
        return organization()->logoUrl();
    }
}
