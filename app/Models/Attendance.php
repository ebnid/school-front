<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'date',
        'clock_in',
        'clock_out'
    ];


    protected $casts = [
        'date' => 'datetime',
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
    ];


    // Dynamic Attribute
    public function getWorktimeAttribute()
    {

    }

    public function getAbsentAttribute()
    {
        return !$this->clock_in && !$this->clock_out;
    }
}
