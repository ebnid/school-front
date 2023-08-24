<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Traits\WithSweetAlert;

class CreateLeave extends Component
{

    use WithSweetAlert;
    
    public $search;
    public $select_employees = [];

    public $leave_start;
    public $leave_end;
    public $leave_type = 'off-day';


    protected $rules = [
        'leave_start' => ['required', 'date'],
        'leave_end' => ['required', 'date'],
        'select_employees' => ['required', 'array'],
    ];


    public function render()
    {
        $employees = $this->getEmployees();
        return view('admin.components.create-leave', compact('employees'));
    }


    public function createLeave()
    {
        $this->validate();

        $start = Carbon::parse($this->leave_start);
        $end = Carbon::parse($this->leave_end);
        $employees = $this->getSelectEmployees();

        while ($start->lte($end)) {
            
            foreach($employees as $employee){

                $attendance = new Attendance();

                $attendance->in_at = $start->format('Y-m-d') . ' ' . $employee->shift->start_at->format('H:i:s');
                $attendance->out_at = $start->format('Y-m-d') . ' ' . $employee->shift->end_at->format('H:i:s');
                $attendance->type = $this->leave_type;
                $attendance->employee_id = $employee->id;
                $attendance->created_at = $start;

                $attendance->save();

            }

            // Move to the next day
            $start->addDay();
        }


        $this->select_employees = [];
        $this->leave_start = null;
        $this->leave_end = null;

        return $this->success('Created', '');

    }


    public function toggleBulkSelect()
    {
        if(!count($this->select_employees) > 0){
            $this->select_employees = Employee::where('status', 'running')->pluck('id');
        }
        else {
            $this->select_employees = [];
        }
    }

    private function getSelectEmployees()
    {
        return Employee::whereIn('id', $this->select_employees)->get();
    }

    private function getEmployees()
    {
        $query = Employee::with('user');

        $search_term = $this->search;

        $query->when($search_term, function($query) use($search_term){
            $query->whereHas('user', function($query) use($search_term){
                $query->where('name', 'like', '%' . $search_term . '%')
                      ->orWhere('name', $search_term)
                      ->orWhere('email', 'like', '%' . $search_term . '%')
                      ->orWhere('email', $search_term);
            });
        });

        return $query->where('status', 'running')->get();
    }
}
