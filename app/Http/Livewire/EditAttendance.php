<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Employee;
use App\Traits\WithSweetAlert;
use Carbon\Carbon;

class EditAttendance extends Component
{

    use WithSweetAlert;

    public $is_edit_mode_on = false;

    public $attendance;
    public $employees = [];


    public $in_at;
    public $out_at;

    // Boolean
    public $is_in_next_day;
    public $is_out_next_day;


    protected $rules = [
        'attendance.early_out_reason' => ['nullable', 'string', 'max:255'], 
        'attendance.late_type' => ['nullable', 'string', 'in:payable,non-payable', 'max:255'], 
        'attendance.early_out_type' => ['nullable', 'string', 'in:payable,non-payable', 'max:255'], 
        'attendance.type' => ['required', 'string', 'in:replace,present,absent,off-day,pay-leave,no-payleave', 'max:255'],
        'attendance.replace_employee_id' => ['nullable', 'numeric'], 
        'attendance.late_cover_id' => ['nullable', 'numeric'], 
        'attendance.overtime_from_id' => ['nullable', 'numeric'],
        'in_at' => ['required', 'date_format:H:i:s'],
        'out_at' => ['required', 'date_format:H:i:s'],
        'is_in_next_day' => ['nullable', 'boolean'],
        'is_out_next_day' => ['nullable', 'boolean'],
    ];


    protected $listeners = [
        'onAttendanceEdit' => 'preparedEditModal',
        'attendanceUpdated' => '$refresh',
    ];

    public function render()
    {
        return view('admin.components.edit-attendance');
    }


    public function updatedInAt($value)
    {
        $this->in_at = "{$value}:00";
    }

    public function updatedOutAt($value)
    {
        $this->out_at = "{$value}:00";
    }


    public function updateAttendanceHandeler()
    {
        $this->validate();

        $this->updateOfficeInTime();
        $this->updateOfficeOutTime();

        try {

            $this->attendance->save();

            $this->emit('attendanceUpdated');


            return $this->success('Updated', '');
        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }


    public function updateOfficeInTime()
    {

        if($this->checkIsLate() || $this->is_in_next_day){
            return $this->updateOfficeLateIn();
        }else {
            return $this->updateOfficeInTimeIn();
        }

    }


    private function updateOfficeLateIn()
    {

        $lateTimeInMinute = $this->countLateMinutes();

        $this->attendance->in_at = $this->in_at;
        $this->attendance->late_time = $lateTimeInMinute;

        if(!$this->attendance->late_type){
            $this->attendance->late_type = Attendance::LATE_TYPE_NON_PAYABLE;
        }

    }

    private function updateOfficeInTimeIn()
    {
        $this->attendance->in_at = $this->in_at;
        $this->attendance->late_time = null;
        $this->attendance->late_type = null;
    }


    public function updateOfficeOutTime()
    {

            $overTimeOrDeductTime = $this->countOvertimeOrEarlyLeftTime();

            if($this->checkIsOvertime() || $this->is_out_next_day){
                $this->attendance->early_out_time = null;
                $this->attendance->overtime = $overTimeOrDeductTime;
                $this->attendance->early_out_type = null;
            }else {
                $this->attendance->early_out_time = $overTimeOrDeductTime;
                $this->attendance->overtime = null;

                if(!$this->attendance->our_out_type){
                    $this->attendance->early_out_type = Attendance::EARLY_OUT_TYPE_NON_PAYABLE;
                }
                
            }

            $this->attendance->out_at = $this->out_at;

    }



    public function cancelEditMode()
    {
        $this->reset();
    }

    public function preparedEditModal($id)
    {
        
        $this->initData();

        $this->attendance = Attendance::with('employee.shift')->find($id);

        $this->in_at = $this->attendance->in_at->format('H:i:s');
        $this->out_at = $this->attendance->out_at->format('H:i:s');

        $this->is_edit_mode_on = true;
    }

    private function countLateMinutes()
    {


        $shift_start = $this->attendance->employee->shift->start_at;

        if(!$this->is_in_next_day){

            $current_time = Carbon::parse($this->in_at);

            return $current_time->diffInMinutes($shift_start);

        }else {

            $working_day_last_time = Carbon::parse('23:59:00');

            $working_days_late_minutes = $working_day_last_time->diffInMinutes($shift_start);

            $next_day_late_minutes = Carbon::parse('00:00:00')->diffInMinutes(Carbon::parse($this->in_at));

            return $working_days_late_minutes + $next_day_late_minutes;

        }

    }

    private function checkIsLate()
    {
        $shift_start = $this->attendance->employee->shift->start_at;

        $current_time = Carbon::parse($this->in_at);

        return $current_time->gt($shift_start);
    }


    private function countOvertimeOrEarlyLeftTime()
    {

        $shift_end = $this->attendance->employee->shift->end_at;


        if(!$this->is_out_next_day) {

            $current_time = Carbon::parse($this->out_at);

            return $current_time->diffInMinutes($shift_end);

        }
        else {

            $working_day_last_time = Carbon::parse('23:59:00');

            $working_days_total_minutes = $working_day_last_time->diffInMinutes($shift_end);

            $next_day_total_minutes = Carbon::parse('00:00:00')->diffInMinutes(Carbon::parse($this->out_at));

            return $working_days_total_minutes + $next_day_total_minutes;

        }

    }

    private function checkIsOvertime()
    {
        $shift_end = $this->attendance->employee->shift->end_at;
        $current_time = Carbon::parse($this->out_at);

        return $current_time->gt($shift_end);
    }


    private function initData()
    {
        $this->employees = Employee::with('user')->where('status', 'running')->get();
    }
}
