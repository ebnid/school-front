<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Leave;

class LeaveResponseDetail extends Component
{

    public $is_leave_response_detail_show = false;
    public $leave;

    protected $listeners = [
        'onLeaveRequestResponseDetail' => 'preparedLeaveRequestResponseDetailModal',
    ];

    public function render()
    {
        return view('admin.components.leave-response-detail');
    }

    public function cancelEditMode()
    {
        $this->reset();
    }


    public function preparedLeaveRequestResponseDetailModal($id)
    {
        $this->leave = Leave::find($id);
        $this->is_leave_response_detail_show = true;
    }


}
