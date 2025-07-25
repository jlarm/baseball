<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Organization;
use Illuminate\Support\Facades\Cache;

final class OrganizationService
{
    public function current(): ?Organization
    {
        return Cache::remember('current_organization', 3600, function () {
            return Organization::first();
        });
    }

    public function name(): string
    {
        return $this->current()?->name ?? config('app.name', 'Application');
    }

    public function logoUrl(): ?string
    {
        $logoPath = $this->current()?->logo_path;

        if (! $logoPath) {
            return null;
        }

        return asset('storage/' . $logoPath);
    }

    public function hasLogo(): bool
    {
        return $this->current()?->logo_path !== null;
    }

    public function clearCache(): void
    {
        Cache::forget('current_organization');
    }
}