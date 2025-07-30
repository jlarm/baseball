<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Division;
use App\Models\Season;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

final class DivisionFactory extends Factory
{
    protected $model = Division::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true).' Division',
            'season_id' => Season::factory(),
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ];
    }
}
