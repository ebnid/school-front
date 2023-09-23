<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class DeleteAttendance extends Component
{
    use WithSweetAlert;

    public $years = [];

    public $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    public $month;
    public $year;

    public $is_has_report = false;


    public function mount()
    {
        $this->generateYear();
        $this->setCurrentDateAndYear();
    }

    public function render()
    {
        return view('admin.components.attendance.delete-attendance');
    }

    public function updatedMonth()
    {
        $this->isHasReport();
    }

    public function updatedYear()
    {
        $this->isHasReport();
    }

    public function startDelete()
    {
        try {
            DB::statement("DELETE FROM attendances WHERE YEAR(date) = {$this->year} AND MONTH(date) = {$this->month}");

            $this->is_has_report = false;

            $this->setCurrentDateAndYear();

            return $this->success('Deleted', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    public function isHasReport()
    {
        $this->is_has_report = Attendance::whereYear('date', $this->year)->whereMonth('date', $this->month)->exists();
    }

    private function setCurrentDateAndYear()
    {
        $this->year = now()->year;
        $this->month = now()->month;
    }

    private function generateYear()
    {
        $currentYear = intval(date('Y'));
        $startYear = config('setting.show_year_from_in_select');
        
        for($currentYear; $currentYear >= $startYear; $currentYear--){
            $this->years[] = $currentYear;
        }
    }
}
