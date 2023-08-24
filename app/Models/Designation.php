<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
use LaracraftTech\LaravelDateScopes\DateScopes;

class Designation extends Model
{
    use HasFactory;
    use DateScopes;


    // Relationship
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    
}
