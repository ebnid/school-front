<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaracraftTech\LaravelDateScopes\DateScopes;
use App\Models\Employee;

class Withdraw extends Model
{
    use HasFactory;
    use DateScopes;




    // Relation
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
