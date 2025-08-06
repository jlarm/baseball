<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
