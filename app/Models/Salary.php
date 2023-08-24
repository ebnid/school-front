<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaracraftTech\LaravelDateScopes\DateScopes;
use App\Models\Employee;

class Salary extends Model
{
    use HasFactory;
    use DateScopes;


    protected $casts = [
        'month_of_salary' => 'datetime',
        'paid_at' => 'datetime',
    ];

    // Relation
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
