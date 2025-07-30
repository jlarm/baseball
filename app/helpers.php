<?php

declare(strict_types=1);

use App\Services\OrganizationService;
use App\Services\SeasonService;

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

if (! function_exists('season')) {
    function season(): SeasonService
    {
        return app(SeasonService::class);
    }
}

if (! function_exists('current_season')) {
    function current_season(): ?App\Models\Season
    {
        return season()->current();
    }
}

if (! function_exists('season_year')) {
    function season_year(): string
    {
        return season()->year();
    }
}
