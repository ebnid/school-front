<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\Attendance;
use App\Traits\WithSweetAlert;


class AllAttendenceList extends Component
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
    public $shift;

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
        $this->setSessionSalaryMonthAndYear();
        $attendances = $this->getAttendances();
        return view('admin.components.all-attendence-list', compact('attendances'));
    }

    public function updatedEmployeeId($id)
    {
        $this->employee = Employee::with('shift', 'user')->find($id);
        $this->shift = $this->employee->shift;
    }

    private function getAttendances()
    {

        if(!$this->employee) return;

        $query = Attendance::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;


        $query->when($year && $month, function($query) use($year, $month){
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        });

        return $query->where('employee_id', $this->employee->id)->get();

    }

    public function editHandeler($id)
    {
        return $this->emit('onAttendanceEdit', $id);
    }

    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onAttendanceDelete', $id, 'Are you sure ?', 'Attendance will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Attendance::destroy($id);

            $this->initData();

            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }

    private function initData()
    {
        $this->setCurrentEmployeDetails();
        $this->generateYear();
        $this->getEmployees();
    }

    private function setSessionSalaryMonthAndYear()
    {
        if($this->month && $this->year){
            session()->put('salary_year', intval($this->year));
            session()->put('salary_month', intval($this->month));
        }
    }

    private function setCurrentEmployeDetails()
    {
        $this->year = now()->year;
        $this->month = now()->month;
        $this->employee = Employee::with('shift', 'user')->where('user_id', auth()->id())->first();
        $this->shift = $this->employee->shift;
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
