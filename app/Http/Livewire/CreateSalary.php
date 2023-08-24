<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\Withdraw;
use App\Models\Attendance;
use App\Traits\WithSweetAlert;
use Carbon\Carbon;

class CreateSalary extends Component
{

    use WithPagination;
    use WithSweetAlert;

    public $years = [];
    public $employees = [];

    public $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    // Filter Props
    public $is_already_salary_done;
    public $year;
    public $month;
    public $employee_id;

    // Data Props
    public $duties = [];
    public $withdraws = [];
    public $replace_duties = [];

    // Daily Duty
    public $duty_total_basic = 0;
    public $duty_total_late_deduct = 0;
    public $duty_total_early_left_deduct = 0;
    public $duty_total_overtime = 0;
    public $duty_total_salary = 0;

    // Replace/Overtime Duty
    public $replace_total_basic = 0;
    public $replace_total_late_deduct = 0;
    public $replace_total_early_left_deduct = 0;
    public $replace_total_overtime = 0;
    public $replace_total_salary = 0;

    // Withdraws
    public $withdraw_total_amount = 0;

    // Salary
    public $total_monthly_salary = 0;
    public $total_previous_overpaid = 0;
    public $this_month_overpaid = 0;
    public $additional_bonous = 0;
    public $message;


    protected $listeners = [
        'onCreateSalary' => 'applyCreateSalary'
    ];


    protected $rules = [
        'message' => ['nullable', 'string', 'max:2048'],
    ];


    public function mount()
    {
        $this->generateYear();
        $this->getEmployees();

        $this->setDefaultEmployeeYearMonth();

        $this->initData();
    }


    public function render()
    {
        return view('admin.components.create-salary');
    }


    public function updated()
    {
        $this->initData();
    }


    public function createSalary()
    {
        return $this->ifConfirmThenDispatch('onCreateSalary', null, 'Are you sure ?', 'Click yes, for creating salary !');
    }

    public function applyCreateSalary()
    {
        $this->validate();

        try {

            $salary = new Salary();
            $salary->month_of_salary = Carbon::create(intval($this->year), intval($this->month), 1);
            $salary->salary_amount = $this->total_monthly_salary;
            $salary->overpaid_amount = abs($this->this_month_overpaid);
            $salary->additional_bonous = $this->additional_bonous;
            $salary->message = $this->message;
            $salary->employee_id = $this->employee_id;

            $salary->save();

            $this->initData();

            return $this->success('Done', '');

        }catch(\Exception $e){
            return $this->error('Failer !', $e->getMessage());
        }
    }


    private function initData()
    {
        $this->resetNecessaryProperty();

        $this->setSessionSalaryMonthAndYear();

        $this->checkIsSalaryAlreadyCreated();

        $this->setLastSalaryOverpaidAmount();

        $this->duties = $this->getDuties();
        $this->replace_duties = $this->getReplaceDuties();
        $this->withdraws = $this->getWithdraws();

        $this->calculateTotalDutiesSummery();
        $this->calculateTotalReplaceDutiesSummery();
        $this->calculateTotaWithdrawsSummery();
        $this->calculateTotalMonthlySalary();

    }


    private function setSessionSalaryMonthAndYear()
    {
        if($this->month && $this->year){
            session()->put('salary_year', intval($this->year));
            session()->put('salary_month', intval($this->month));
        }
    }

    private function resetNecessaryProperty()
    {

        $this->duty_total_basic = 0;
        $this->duty_total_late_deduct = 0;
        $this->duty_total_early_left_deduct = 0;
        $this->duty_total_overtime = 0;
        $this->duty_total_salary = 0;
    
        // Replace/Overtime Duty
        $this->replace_total_basic = 0;
        $this->replace_total_late_deduct = 0;
        $this->replace_total_early_left_deduct = 0;
        $this->replace_total_overtime = 0;
        $this->replace_total_salary = 0;
    
        // Withdraws
        $this->withdraw_total_amount = 0;
    
        // Salary
        $this->total_monthly_salary = 0;
        $this->total_previous_overpaid = 0;
        $this->this_month_overpaid = 0;
    }

    private function setDefaultEmployeeYearMonth()
    {
        $this->year = now()->year;
        $this->month = now()->month;

        $this->employee_id = auth()->user()->employee->id ?? null;
    }

    private function checkIsSalaryAlreadyCreated()
    {
        $this->is_already_salary_done = Salary::whereYear('month_of_salary', $this->year)->whereMonth('month_of_salary', $this->month)->where('employee_id', $this->employee_id)->exists();
    }
 

    private function setLastSalaryOverpaidAmount()
    {

        $year = intval($this->year);
        $month = intval($this->month) - 1;

        $last_salary = Salary::where('employee_id', $this->employee_id)->whereYear('month_of_salary', $year)->whereMonth('month_of_salary', $month)->first();

        if($last_salary){
            $this->total_previous_overpaid = $last_salary->overpaid_amount;
        }

    }


    private function calculateTotalMonthlySalary()
    {
        $total_monthly_salary = ($this->duty_total_salary + $this->replace_total_salary + (float) $this->additional_bonous) - ($this->withdraw_total_amount + $this->total_previous_overpaid);

        if($total_monthly_salary != abs($total_monthly_salary)){
            $this->total_monthly_salary = 0;
            $this->this_month_overpaid = $total_monthly_salary;
        }else {
            $this->total_monthly_salary = $total_monthly_salary;
            $this->this_month_overpaid = 0;
        }

    }


    private function calculateTotalDutiesSummery()
    {
        if(!count($this->duties) > 0) return;

        $this->duty_total_basic = $this->duties->sum(fn($duty) => $duty->dailySalrayAmount());
        $this->duty_total_late_deduct = $this->duties->sum(fn($duty) => $duty->lateDeductMoneyAmount());
        $this->duty_total_early_left_deduct = $this->duties->sum(fn($duty) => $duty->earlyLeaveMoneyDeductAmount());
        $this->duty_total_overtime = $this->duties->sum(fn($duty) => $duty->overtimeMoneyAmount());
        $this->duty_total_salary = $this->duties->sum(fn($duty) => $duty->todayTotalSalary());

    }

    private function calculateTotalReplaceDutiesSummery()
    {
        if(!count($this->replace_duties) > 0) return;

        $this->replace_total_basic = $this->replace_duties->sum(fn($duty) => $duty->dailySalrayAmount());
        $this->replace_total_late_deduct = $this->replace_duties->sum(fn($duty) => $duty->lateDeductMoneyAmount());
        $this->replace_total_early_left_deduct = $this->replace_duties->sum(fn($duty) => $duty->earlyLeaveMoneyDeductAmount());
        $this->replace_total_overtime = $this->replace_duties->sum(fn($duty) => $duty->overtimeMoneyAmount());
        $this->replace_total_salary = $this->replace_duties   ->sum(fn($duty) => $duty->todayTotalSalary());
    }

    private function calculateTotaWithdrawsSummery()
    {
        if(!count($this->withdraws) > 0) return;

        $this->withdraw_total_amount = $this->withdraws->sum('amount');
    }

    private function getDuties()
    {

        if(!$this->employee_id) return [];

        $query = Attendance::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;


        $query->when($year && $month, function($query) use($year, $month){
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        });

        $query->where('employee_id', $this->employee_id);

        $query->whereIn('type', ['present', 'off-day', 'pay-leave']);

        return $query->get();

    }


    private function getReplaceDuties()
    {

        if(!$this->employee_id) return [];

        $query = Attendance::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;

        $query->when($year && $month, function($query) use($year, $month){
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        });

        $query->where('replace_employee_id', $this->employee_id);

        $query->where('type', 'replace');

        return $query->get();

    }


    private function getWithdraws()
    {

        if(!$this->employee_id) return [];

        $query = Withdraw::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;

        $query->when($year && $month, function($query) use($year, $month){
            $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
        });

        $query->where('employee_id', $this->employee_id);

        $query->where('status', 'accepted');

        return $query->get();

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
