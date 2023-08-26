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
    public $employee;

    protected $listeners = [
        'onAttendanceDelete' => 'applyDelete',
        'attendanceUpdated' => '$refresh',
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

    private function getOvertimes()
    {

        $query = Overtime::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;


        $query->when($year && $month, function($query) use($year, $month){
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        });

        return $query->where('employee_id', $this->employee->id)->paginate(12);

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
        $this->employee = Employee::with('shift', 'user')->where('user_id', auth()->id())->first();
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
