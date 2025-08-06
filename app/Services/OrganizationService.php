<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Organization;
use Illuminate\Support\Facades\Cache;

final class OrganizationService
{
    private static ?Organization $cachedOrganization = null;

    private static bool $organizationLoaded = false;

    public function current(): ?Organization
    {
        if (! self::$organizationLoaded) {
            self::$cachedOrganization = Cache::remember('current_organization', 3600, static fn () => Organization::first());
            self::$organizationLoaded = true;
        }

        return self::$cachedOrganization;
    }

    public function name(): string
    {
        $organization = $this->current();

        return $organization instanceof Organization ? $organization->name : config('app.name', 'Application');
    }

    public function logoUrl(): ?string
    {
        $logoPath = $this->current()?->logo_path;

        if (! $logoPath) {
            return null;
        }

        return asset('storage/'.$logoPath);
    }

    public function hasLogo(): bool
    {
        return $this->current()?->logo_path !== null;
    }

    public function clearCache(): void
    {
        Cache::forget('current_organization');
        self::$cachedOrganization = null;
        self::$organizationLoaded = false;
    }
}
