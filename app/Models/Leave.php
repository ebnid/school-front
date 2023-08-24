<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaracraftTech\LaravelDateScopes\DateScopes;
use App\Models\Employee;
class Leave extends Model
{
    use HasFactory;
    use DateScopes;

    protected $casts = [
        'from_date' => 'datetime',
        'to_date' => 'datetime',
    ];

    // Relationship
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
