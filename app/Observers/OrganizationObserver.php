<?php

namespace App\Observers;

use App\Models\Organization;
use Illuminate\Support\Str;

class OrganizationObserver
{
    public function creating(Organization $organization): void
    {
        $organization->uuid = (string) Str::uuid();
    }
}
