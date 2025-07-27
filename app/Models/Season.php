<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

final class Season extends Model
{
    protected $casts = [
        'status' => Status::class,
    ];
}
