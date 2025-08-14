<?php

namespace App\Models;

use App\Observers\SeasonObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(SeasonObserver::class)]
class Season extends Model
{
    protected $fillable = [
        'uuid',
        'name',
    ];

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
        ];
    }
}
