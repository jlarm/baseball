<?php

namespace App\Observers;

use App\Models\Season;
use Str;

class SeasonObserver
{
    public function creating(Season $season): void
    {
        $season->uuid = (string) Str::uuid();
    }
}
