<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\Withdraw;
use App\Models\Attendance;
use Carbon\Carbon;

class SalaryDetail extends Controller
{

    // Filter
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
    public $employee;
    public $date;


    public function __invoke(Request $request)
    {
        $salaryId = $request->salary_id;

        $salary = $this->getSalary($salaryId);

        if(!$salary){
            return abort(403);
        }else {
            $this->year = $salary->month_of_salary->year;
            $this->month = $salary->month_of_salary->month;
            $this->employee_id = $salary->employee_id;
            $this->message = $salary->message;
            $this->employee = $salary->employee;
            $this->date = $salary->month_of_salary->format('M Y');
            $this->salary = $salary->salary_amount;
            $this->bonous = $salary->additional_bonous;
            $this->additional_bonous = $salary->additional_bonous;
            $this->overpiad = $salary->overpaid_amount;
        }

        $this->preapredSalaryDetails();


        $data = [
            'duties' => $this->duties,
            'withdraws' => $this->withdraws,
            'replace_duties' => $this->replace_duties,
            'duty_total_basic' => $this->duty_total_basic,
            'duty_total_late_deduct' => $this->duty_total_late_deduct,
            'duty_total_early_left_deduct' => $this->duty_total_early_left_deduct,
            'duty_total_overtime' => $this->duty_total_overtime,
            'duty_total_salary' => $this->duty_total_salary,
            'replace_total_basic' => $this->replace_total_basic,
            'replace_total_late_deduct' => $this->replace_total_late_deduct,
            'replace_total_early_left_deduct' => $this->replace_total_early_left_deduct,
            'replace_total_overtime' => $this->replace_total_overtime,
            'replace_total_salary' => $this->replace_total_salary,
            'withdraw_total_amount' => $this->withdraw_total_amount,
            'total_monthly_salary' => $this->total_monthly_salary,
            'total_previous_overpaid' => $this->total_previous_overpaid,
            'this_month_overpaid' => $this->this_month_overpaid,
            'additional_bonous' => $this->additional_bonous,
            'message' => $this->message,
            'employee' => $this->employee,
            'date' => $this->date,
            'salary' => $this->salary,
            'bonous' => $this->bonous,
            'overpiad' => $this->overpiad,
        ];

        return view('admin.pages.salary.salary-details', $data);
    }


    private function preapredSalaryDetails()
    {

        $this->setSessionSalaryMonthAndYear();

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

        $query = Attendance::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;


        $query->whereMonth('created_at', $month)->whereYear('created_at', $year);

        $query->where('employee_id', $this->employee_id);

        $query->whereIn('type', ['present', 'off-day', 'pay-leave']);

        return $query->get();

    }


    private function getReplaceDuties()
    {

        $query = Attendance::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;

        $query->whereMonth('created_at', $month)->whereYear('created_at', $year);

        $query->where('replace_employee_id', $this->employee_id);

        $query->where('type', 'replace');

        return $query->get();

    }


    private function getWithdraws()
    {

        $query = Withdraw::query();

        $year = $this->year;
        $month = $this->month;
        $employee_id = $this->employee_id;

        $query->whereMonth('created_at', $month)->whereYear('created_at', $year);

        $query->where('employee_id', $this->employee_id);

        $query->where('status', 'accepted');

        return $query->get();

    }

    private function getSalary($id)
    {
        return Salary::find($id);
    }
}
