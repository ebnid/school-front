<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Leave;
use App\Models\Attendance;
use App\Models\Employee;
use App\Traits\WithSweetAlert;
use Carbon\Carbon;

class CreateLeaveResponse extends Component
{
    use WithSweetAlert;
    public $is_response_mode_on = false;

    public $leave;
    public $from_date;
    public $to_date;
    public $type;

    public $rules = [
        'leave.status' => ['required', 'string', 'max:255'],
        'leave.management_response' => ['required', 'string', 'max:2048'],
        'from_date' => ['required', 'date'],
        'to_date' => ['required', 'date'],
        'type' => ['required', 'string', 'max:255'],
    ];

    protected $listeners = [
        'onLeaveResponseModalShow' => 'preapredLeaveResponseModal',
    ];

    public function render()
    {
        return view('admin.components.create-leave-response');
    }


    public function cancelEditMode()
    {
        $this->reset();
    }

    public function sendResponse()
    {

        if($this->leave->status === 'canceled'){
            return $this->cancelResponseHandeler();
        }

        if($this->leave->status === 'accepted'){
            return $this->acceptedResponseHandeler();
        }

        return $this->info('You do not select status', 'Status must be canceled or accepted.');
    }

    private function acceptedResponseHandeler()
    {

        $this->validate();

        try {

            $this->updateLeave();
            $this->createLeave();

            $this->reset();

            $this->emit('onLeaveRequestRefresh');

            return $this->success('Done !', '');
           
        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    private function updateLeave()
    {
        $this->leave->from_date = $this->from_date;
        $this->leave->to_date = $this->to_date;
        $this->leave->save();
    }


    private function createLeave()
    {
        $start = Carbon::parse($this->leave->from_date);
        $end = Carbon::parse($this->to_date);

        $employee = Employee::find($this->leave->employee_id);

        while ($start->lte($end)) {
            
            $attendance = new Attendance();

            $attendance->in_at = $start->format('Y-m-d') . ' ' . $employee->shift->start_at->format('H:i:s');
            $attendance->out_at = $start->format('Y-m-d') . ' ' . $employee->shift->end_at->format('H:i:s');
            $attendance->type = $this->type;
            $attendance->employee_id = $employee->id;
            $attendance->created_at = $start;

            $attendance->save();

            // Move to the next day
            $start->addDay();
        }
 
    }

    private function cancelResponseHandeler()
    {
        try {

            $this->updateLeave();

            $this->reset();

            $this->emit('onLeaveRequestRefresh');

            return $this->success('Done !', '');
            
        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    public function preapredLeaveResponseModal($id)
    {
        $this->leave = Leave::find($id);

        $this->from_date = $this->leave->from_date->format('Y-m-d');
        $this->to_date = $this->leave->to_date->format('Y-m-d');

        $this->is_response_mode_on = true;
    }
}
