<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Model Scope

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
    
}
