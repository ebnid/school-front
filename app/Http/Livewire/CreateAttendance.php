<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Employee;
use App\Traits\WithSweetAlert;
use Carbon\Carbon;

class CreateAttendance extends Component
{
    use WithSweetAlert;

    public $employee;
    public $employees = [];


    public $employee_id;
    public $attendance_date;
    public $in_at;
    public $out_at;
    public $early_out_reason;
    public $late_type;
    public $early_out_type;
    public $type;
    public $replace_employee_id;
    public $late_cover_id;
    public $overtime_from_id;

    public $overtime;
    public $late_time;
    public $early_out_time;

    public $is_in_next_day = false;
    public $is_out_next_day = false;



    protected $rules = [
        'employee_id' => ['required', 'numeric'],
        'attendance_date' => ['required', 'date'],
        'type' => ['required', 'string', 'in:replace,present,absent,off-day,pay-leave,no-payleave', 'max:255'],
        'early_out_reason' => ['nullable', 'string', 'max:255'], 
        'late_type' => ['nullable', 'string', 'in:payable,non-payable', 'max:255'], 
        'early_out_type' => ['nullable', 'string', 'in:payable,non-payable', 'max:255'], 
        'replace_employee_id' => ['nullable', 'numeric'], 
        'late_cover_id' => ['nullable', 'numeric'], 
        'overtime_from_id' => ['nullable', 'numeric'],
        'in_at' => ['required', 'date'],
        'out_at' => ['required', 'date'],
        'is_in_next_day' => ['nullable', 'boolean'],
        'is_out_next_day' => ['nullable', 'boolean'],
    ];


    public function mount()
    {
        $this->initData();
    }

    public function render()
    {
        return view('admin.components.create-attendance');
    }


    public function createAttendanceHandeler()
    {
        $this->validate();

        try {

            $attendance = new Attendance();

            $attendance->employee_id = $this->employee_id;
            $attendance->created_at = $this->attendance_date;

            $attendance->in_at = $this->in_at;
            $attendance->out_at = $this->out_at;
            $attendance->late_time = $this->late_time;
            $attendance->overtime = $this->overtime;
            $attendance->type = $this->type;
            $attendance->late_type = $this->late_type;
            $attendance->early_out_type = $this->early_out_type;
            $attendance->replace_employee_id = $this->replace_employee_id;
            $attendance->late_cover_id = $this->late_cover_id;

            $attendance->save();

            $this->reset();

            $this->initData();
            
            return $this->success('Created', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }

    }


    private function initData()
    {
        $this->employees = Employee::with('user')->where('status', 'running')->get();
    }

}
