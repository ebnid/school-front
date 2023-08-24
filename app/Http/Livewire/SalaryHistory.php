<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Salary;
use App\Models\Employee;
use App\Traits\WithSweetAlert;;

class SalaryHistory extends Component
{
    use WithSweetAlert;

    public $years = [];
    public $employees = [];

    public $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    // Filter Props
    public $year;
    public $month;
    public $employee_id;

    public function mount()
    {
        $this->generateYear();
        $this->getEmployees();

        $this->setDefaultEmployeeYearMonth();
    }

    public function render()
    {
        $salaries = $this->getSalary();
        return view('admin.components.salary-history', compact('salaries'));
    }

    public function getSalary()
    {
        $query = Salary::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;

        $query->when($year && $month, function($query) use($year, $month){
            $query->whereMonth('month_of_salary', $month)->whereYear('month_of_salary', $year);
        });

        $query->when($employee_id, function($query) use($employee_id){
            $query->where('employee_id', $employee_id);
        });

        return $query->latest()->paginate(12);
    }

    public function confirmRecieved($id)
    {
        try {

            $salary = Salary::find($id);

            $salary->paid_at = now();

            $salary->save();

            return $this->success('Confirmed', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    private function setDefaultEmployeeYearMonth()
    {
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
