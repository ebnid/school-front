<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Overtime;
use App\Traits\WithSweetAlert;

class CreateOvertime extends Component
{

    use WithSweetAlert;

    public $last_attendance;
    public $last_overtime;
    public $employee;

    public $current_overtime;
    public $is_unfinished_overtime = false;


    public function mount()
    {
        $this->initData();
    }

    public function render()
    {
        return view('admin.components.create-overtime');
    }

    public function initData()
    {
        $this->setCurrentEmployee();
        $this->last_attendance = $this->getLastAttendance();
        $this->last_overtime = $this->getLastOvetime();
        $this->current_overtime = $this->countCurrentOvertimeInMinutes();
    }


    public function refreshOvertime()
    {
        $this->initData();
    }

    public function startOvertime()
    {

        try {

            $overtime = new Overtime();
            $overtime->start_at = now();
            $overtime->attendance_id = $this->last_attendance->id;
            $overtime->employee_id = $this->employee->id;
            $overtime->status = 'pending';

            $overtime->save();
            
            $this->initData();

            return $this->success('Overtime started', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }


    public function endOvertime()
    {
        try {

            $this->last_overtime->end_at = now();

            $this->last_overtime->save();

            $this->last_overtime->overtime = $this->countCurrentOvertimeInMinutes();

            $this->last_overtime->save();
            
            $this->is_unfinished_overtime = false;

            $this->emit('onNewOvertimeCreated');

            $this->initData();

            return $this->success('Overtime Finished', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }


    private function countCurrentOvertimeInMinutes()
    {
        if($this->last_overtime && $this->last_overtime->start_at) {
            $overtime_start = $this->last_overtime->start_at;
            $current_time = now();
    
            return $current_time->diffInMinutes($overtime_start);
        }

        return 0;
    }


    private function setCurrentEmployee()
    {
        $this->employee = auth()->user()->employee ?? null;
    }
    
    private function getLastOvetime()
    {
        $last_overtime =  Overtime::where('employee_id', $this->employee->id)->latest()->first();

        if($last_overtime && $last_overtime->start_at && !$last_overtime->end_at){
            $this->is_unfinished_overtime = true;
        }

        return $last_overtime;
    }

    private function getLastAttendance()
    {
        return Attendance::where('employee_id', $this->employee->id)->latest()->first();
    }

}
