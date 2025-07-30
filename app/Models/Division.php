<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'season_id',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
