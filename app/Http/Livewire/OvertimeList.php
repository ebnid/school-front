<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Overtime;
use App\Models\Employee;
use App\Traits\WithSweetAlert;

class OvertimeList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $years = [];
    public $employees = [];

    public $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];


    // Filter Property
    public $year;
    public $month;
    public $employee_id;

    protected $listeners = [
        'onOvertimeDelete' => 'applyDelete',
        'onOvertimeRefresh' => '$refresh',
    ];

    public function mount()
    {
        $this->initData();
    }

    public function render()
    {
        $overtimes = $this->getOvertimes();
        return view('admin.components.overtime-list', compact('overtimes'));
    }

    public function updatedEmployeeId($id)
    {
        $this->employee = Employee::with('shift', 'user')->find($id);
    }


    public function cancelOvertimeHandeler($id)
    {
        try {

            $overtime = Overtime::find($id);

            $overtime->status = 'canceled';

            $overtime->save();

            $this->recalculateAndSaveOvertime($id);

            $this->emit('onOvertimeRefresh');

            return $this->success('Canceled', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    public function acceptOvertimeHandeler($id)
    {
        try {

            $overtime = Overtime::find($id);

            $overtime->status = 'accepted';

            $overtime->save();

            $this->recalculateAndSaveOvertime($id);

            $this->emit('onOvertimeRefresh');

            return $this->success('Canceled', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    private function recalculateAndSaveOvertime($overtime_id)
    {
        $overtime = Overtime::with('attendance')->find($overtime_id);

        $attendance = $overtime->attendance;

        $attendance->extra_overtime = Overtime::where('status', 'accepted')->where('attendance_id', $attendance->id)->sum('overtime');

        $attendance->save();

    }

    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onOvertimeDelete', $id, 'Are you sure ?', 'Overtime will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Overtime::destroy($id);
            
            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }

    private function getOvertimes()
    {

        $query = Overtime::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;


        $query->when($year && $month, function($query) use($year, $month){
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        });

        $query->when($employee_id, function($query) use($employee_id){
            $query->where('employee_id', $employee_id);
        });

        return $query->latest()->paginate(12);

    }


    private function initData()
    {
        $this->setCurrentEmployeDetails();
        $this->generateYear();
        $this->getEmployees();
    }


    private function setCurrentEmployeDetails()
    {
        $this->year = now()->year;
        $this->month = now()->month;
        $this->employee_id = auth()->user()->employee->id;
    }

    private function generateYear()
    {
        $currentYear = intval(date('Y'));
        $startYear = config('setting.show_year_from_in_select');
        
        for($currentYear; $currentYear >= $startYear; $currentYear--){
            $this->years[] = $currentYear;
        }
    }

    private function getEmployees()
    {
        $this->employees = Employee::with('user')->where('status', 'running')->get();
    }
}
