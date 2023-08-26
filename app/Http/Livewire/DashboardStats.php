<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Withdraw;

class DashboardStats extends Component
{

    public $salary = 0;
    public $withdraw = 0;
    public $balance = 0;

    public $employee_id;

    public function mount()
    {
        $this->employee_id = auth()->user()->employee->id;

        $this->calculateCurrentSalaryOfThisMonth();
        $this->calculateCurrentWithdrawOfThisMonth();
        $this->calculateCurrentBalanceOfThisMonth();
    }

    public function render()
    {
        return view('admin.components.dashboard-stats');
    }

    private function calculateCurrentSalaryOfThisMonth()
    {
        $attendances = Attendance::where('employee_id', $this->employee_id)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->whereIn('type', ['off-day', 'pay-leave', 'present'])->get();
        $repalce_attendances = Attendance::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->where('replace_employee_id', $this->employee_id)->where('type', 'replace')->get();

        $regular_total_salary = $attendances   ->sum(fn($item) => $item->todayTotalSalary());

        $replace_total_salary = $repalce_attendances   ->sum(fn($item) => $item->todayTotalSalary());

        $total_salary = $regular_total_salary + $replace_total_salary;

        $this->salary = $replace_total_salary + $total_salary;
        
    }

    private function calculateCurrentWithdrawOfThisMonth()
    {
        $withdraws = Withdraw::where('employee_id', $this->employee_id)->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->where('status', 'accepted')->get();

        $this->withdraw = $withdraws->sum('amount');

    }

    private function calculateCurrentBalanceOfThisMonth()
    {
        $this->balance = $this->salary - $this->withdraw;
    }

}
