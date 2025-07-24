<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\OrganizationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(OrganizationObserver::class)]
final class Organization extends Model
{
    use HasFactory;

    protected $casts = [
        'uuid' => 'string',
    ];
}
