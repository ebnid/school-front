<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attendance;

class DashboardUnfinishedAttendanceList extends Component
{

    use WithPagination;

    public $employee_id;

    public function mount()
    {
        $this->employee_id = auth()->user()->employee->id;
    }

    public function render()
    {
        $attendances = $this->getUnfinishedAttendanceList();
        return view('admin.components.dashboard-unfinished-attendance-list', compact('attendances'));
    }

    public function getUnfinishedAttendanceList()
    {
        return Attendance::where('employee_id', $this->employee_id)->where('out_at', null)->paginate(10);
    }
}
