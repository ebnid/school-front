<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;
use App\Models\Attendance;
use App\Traits\WithSweetAlert;
use Carbon\Carbon;

class SingleTeacherSummery extends Component
{

    public $years = [];

    public $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    public $teachers = [];

    public $month;
    public $year;
    public $teacher;


    public $attendances = [];


    public function mount()
    {
        $this->teachers = $this->getAllTeachers();
        $this->initData();
    }

    public function render()
    {
        $this->teachers = $this->getAllTeachers();
        $this->attendances = $this->getAttendances();
        return view('admin.components.attendance.single-teacher-summery');
    }

    private function getAttendances()
    {
        if(!($this->month && $this->year && $this->teacher)) return [];


        $query = Attendance::query();

        $query->whereMonth('date', $this->month);

        $query->whereYear('date', $this->year);

        $query->where('name', $this->teacher);

        return $query->get();
    }

    private function setCurrentDateAndYear()
    {
        $this->year = now()->year;
        $this->month = now()->month;
    }

    private function getAllTeachers()
    {
        return Attendance::select('name')->groupBy('name')->get();
    }

    public function initData()
    {
        $this->generateYear();
        $this->setCurrentDateAndYear();
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
