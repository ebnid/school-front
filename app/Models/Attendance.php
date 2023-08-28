<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaracraftTech\LaravelDateScopes\DateScopes;
use App\Models\Employee;
use App\Models\Overtime;

class Attendance extends Model
{
    use HasFactory;
    use DateScopes;


    public const LATE_TYPE_PAYABLE = 'payable';
    public const LATE_TYPE_NON_PAYABLE = 'non-payable';
    public const EARLY_OUT_TYPE_PAYABLE = 'payable';
    public const EARLY_OUT_TYPE_NON_PAYABLE = 'non-payable';

    public const ATTENDANCE_REPLACE = 'replace';
    public const ATTENDANCE_PRESENT = 'present';
    public const ATTENDANCE_PAY_LEAVE = 'pay-leave';
    public const ATTENDANCE_NO_PAY_LEAVE = 'nopay-leave';
    public const ATTENDANCE_ABSENT = 'absent';
    public const ATTENDANCE_OFF_DAY = 'off-day';

    protected $casts = [
        'in_at' => 'datetime',
        'out_at' => 'datetime',
    ];


    // Relationship
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function overtimeList()
    {
        return $this->hasMany(Overtime::class);
    }

    public function lateCoverEmployee()
    {
        return $this->belongsTo(Employee::class, 'late_cover_id');
    }

    public function overtimeFromEmploye()
    {
        return $this->belongsTo(Employee::class, 'overtime_from_id');
    }

    public function replaceEmployee()
    {
        return $this->belongsTo(Employee::class, 'replace_employee_id');
    }

    // Dynamic Value

    public function getStatus()
    {
        return $this->convertSlugToUcFirst($this->type);
    }

    public function overtime()
    {
        return (float) $this->overtime + (float) $this->extra_overtime;
    }

    public function getLateTypeStatus()
    {
        return $this->convertSlugToUcFirst($this->late_type);
    }

    public function getEarlyLeftTypeStatus()
    {
        return $this->convertSlugToUcFirst($this->early_out_type);
    }

    private function convertSlugToUcFirst($slug)
    {
        return implode(' ', array_map('ucfirst', explode('-', $slug)));
    }

    public function lateDeductMoneyPercent()
    {
        if($this->late_type === Attendance::LATE_TYPE_PAYABLE) return 0;

        return ( $this->lateDeductMoneyAmount() / $this->dailySalrayAmount() ) * 100;
    }

    public function lateDeductMoneyAmount()
    {
        if($this->late_type === Attendance::LATE_TYPE_PAYABLE) return 0;

        return $this->employee->salaryPerMinute() * $this->late_time;
    }

    public function overtimeMoneyAmountPercent()
    {
        return ( $this->overtimeMoneyAmount() / $this->dailySalrayAmount() ) * 100;
    }

    public function overtimeMoneyAmount()
    {
        return $this->employee->salaryPerMinute() * $this->overtime();
    }


    public function earlyLeaveMoneyDeductPercent()
    {
        if($this->early_out_type === Attendance::EARLY_OUT_TYPE_PAYABLE) return 0;

        return ( $this->earlyLeaveMoneyDeductAmount() / $this->dailySalrayAmount() ) * 100;
    }

    public function earlyLeaveMoneyDeductAmount()
    {
        if($this->early_out_type === Attendance::EARLY_OUT_TYPE_PAYABLE) return 0;

        return $this->employee->salaryPerMinute() * $this->early_out_time;
    }

    public function dailySalrayAmount()
    {
        return $this->employee->salaryPerMinute() * config('setting.duty_per_day_hour') * 60;
    }

    public function todayTotalSalary()
    {
        
        return ($this->dailySalrayAmount() + $this->overtimeMoneyAmount()) - ($this->lateDeductMoneyAmount() + $this->earlyLeaveMoneyDeductAmount());
    }

}
