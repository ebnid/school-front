<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Overtime;

class DashboardOvertimeList extends Component
{
    use WithPagination;

    public $employee_id;

    protected $listeners = [
        'onNewOvertimeCreated' => '$refresh',
    ];

    public function mount()
    {
        $this->employee_id = auth()->user()->employee->id;
    }

    public function render()
    {
        $overtimes = $this->getCurrentEmployeeThisMonthOvertimes();
        return view('admin.components.dashbaord-overtime-list', compact('overtimes'));
    }


    private function getCurrentEmployeeThisMonthOvertimes()
    {
        return Overtime::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->where('employee_id', $this->employee_id)->latest()->paginate(10);
    }
}
