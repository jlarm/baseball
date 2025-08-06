<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Season;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

final class SeasonFactory extends Factory
{
    protected $model = Season::class;

    public function definition(): array
    {
        return [
            'year' => (string) $this->faker->year(),
            'status' => $this->faker->randomElement(Status::cases()),
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => Status::ACTIVE,
        ]);
    }

    public function archived(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => Status::ARCHIVED,
        ]);
    }
}
