<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Leave;

class CreateEditListLeave extends Component
{
    use WithSweetAlert;
    use WithPagination;

    // Form Property
    public $title;
    public $from_date;
    public $to_date;
    public $reason;

    public $is_edit_mode_on = false;
    public $leave_id;

    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
        'from_date' => ['required', 'date'],
        'to_date' => ['required', 'date'],
        'reason' => ['required', 'string', 'max:2048'],
    ];


    protected $listeners = [
        'onLeaveDelete' => 'applyDelete'
    ];


    public function render()
    {
        $leaves = $this->getLeaves();
        return view('admin.components.create-edit-list-leave', compact('leaves'));
    }

    public function leaveRequestResponseDetail($id)
    {
        return $this->emit('onLeaveRequestResponseDetail', $id);
    }


    public function updateLeaveRequest()
    {
        $this->validate();

        
        try {

            $leave = Leave::find($this->leave_id);

            $leave->title = $this->title;
            $leave->from_date = $this->from_date;
            $leave->to_date = $this->to_date;
            $leave->reason = $this->reason;

            $leave->save();

            $this->reset();

            return $this->success('Updated', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }


    public function applyLeaveRequest()
    {
        $this->validate();

        try {

            $leave = new Leave();
            $leave->title = $this->title;
            $leave->from_date = $this->from_date;
            $leave->to_date = $this->to_date;
            $leave->reason = $this->reason;
            $leave->employee_id = auth()->user()->employee->id;

            $leave->save();

            $this->reset();

            return $this->success('Applied', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    public function editHandeler($id)
    {
        $leave = Leave::find($id);
        
        $this->title = $leave->title;
        $this->from_date = $leave->from_date->format('Y-m-d');
        $this->to_date = $leave->to_date->format('Y-m-d');
        $this->reason = $leave->reason;

        $this->leave_id = $leave->id;
        $this->is_edit_mode_on = true;

    }

    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onLeaveDelete', $id, 'Are you sure ?', 'Leave Request will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Leave::destroy($id);

            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    private function getLeaves()
    {
        return Leave::where('employee_id', auth()->user()->employee->id)->latest()->paginate(12);
    }
}
