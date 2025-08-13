<?php

namespace App\Models;

use App\Observers\OrganizationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;

#[ObservedBy(OrganizationObserver::class)]
class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'address',
        'city',
        'state',
        'zip_code',
        'logo',
    ];

    protected static function booted(): void
    {
        static::creating(static function (Organization $organization) {
            if (static::exists()) {
                throw new RuntimeException('Organization already exists');
            }
        });
    }

    public static function current(): ?Organization
    {
        return static::first();
    }

    public static function currentOrNew(): Organization
    {
        return static::first() ?? new static;
    }

    public static function firstOrFail(): Organization
    {
        $organization = static::first();

        if (! $organization) {
            throw new ModelNotFoundException('Organization not found');
        }

        return $organization;
    }
}
