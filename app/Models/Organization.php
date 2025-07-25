<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\State;
use App\Observers\OrganizationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(OrganizationObserver::class)]
final class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_path',
        'address',
        'city',
        'state',
        'zip_code',
        'phone',
        'email',
        'checklist_completed',
    ];

    protected $casts = [
        'uuid' => 'string',
        'state' => State::class,
        'checklist_completed' => 'boolean',
    ];
}
