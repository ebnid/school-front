<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaracraftTech\LaravelDateScopes\DateScopes;

class Shift extends Model
{
    use HasFactory;
    use DateScopes;

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

}
