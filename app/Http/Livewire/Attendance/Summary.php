<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;
use App\Models\Attendance;
use App\Traits\WithSweetAlert;
use Carbon\Carbon;

class Summary extends Component
{
    use WithSweetAlert;

    public $years = [];

    public $months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    public $month;
    public $year;


    public function mount()
    {
        $this->generateYear();
        $this->setCurrentDateAndYear();
    }

    public function render()
    {
        return view('admin.components.attendance.summery');
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
