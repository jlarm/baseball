<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Status;
use App\Models\Season;
use Illuminate\Support\Facades\Cache;

final class SeasonService
{
    private static ?Season $cachedSeason = null;

    private static bool $seasonLoaded = false;

    public function current(): ?Season
    {
        if (! self::$seasonLoaded) {
            self::$cachedSeason = Cache::remember('current_season', 3600, fn () => Season::where('status', Status::ACTIVE)->first());
            self::$seasonLoaded = true;
        }

        return self::$cachedSeason;
    }

    public function year(): string
    {
        $season = $this->current();

        return $season instanceof Season ? $season->year : date('Y');
    }

    public function isActive(): bool
    {
        return $this->current()?->status === Status::ACTIVE;
    }

    public function clearCache(): void
    {
        Cache::forget('current_season');
        self::$cachedSeason = null;
        self::$seasonLoaded = false;
    }
}
