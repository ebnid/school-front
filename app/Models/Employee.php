<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organization;
use App\Models\Designation;
use App\Models\Shift;
use App\Models\Attendance;
use LaracraftTech\LaravelDateScopes\DateScopes;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;
    use DateScopes;



    // Dynamics Value From Function

    public function todayAttendance()
    {
        $pastTime = now()->subHours(16);
        $currentTime = now();

        return Attendance::whereBetween('created_at', [$pastTime, $currentTime])->where('employee_id', $this->id)->first();
    }

    public function salaryPerMinute()
    {
        $daysInMonth = now()->daysInMonth;

        if( session()->has('salary_year') &&  session()->has('salary_month') && session()->get('salary_year') && session()->get('salary_month')){
            $daysInMonth = Carbon::create(session()->get('salary_year'), session()->get('salary_month'), 1)->daysInMonth;
        }

        return ( ($this->basic_salary / $daysInMonth) / config('setting.duty_per_day_hour') ) / 60;
    }


    // Relationship
    public function prevEmployee()
    {
        return $this->belongsTo(static::class, 'prev_employee_id');
    }

    public function nextEmployee()
    {
        return $this->belongsTo(static::class, 'next_employee_id');
    }

    public function attendences()
    {
        return $this->hasMany(Attendence::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    // Dynamic calculation
    public function getLateDeductPercent()
    {
        $totalIncomePerDay = $this->employee->salaryPerMinute() * config('setting.duty_per_day_hour') * 60;

        return ;
    }

    public function getLateDeductMoneyAmount()
    {
        return ;
    }


}
