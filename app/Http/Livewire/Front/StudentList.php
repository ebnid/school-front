<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Student;

class StudentList extends Component
{

    public $years = [];

    // Filter
    public $year;
    public $student_class;
    public $gender;

    public function mount()
    {
        $this->generateYear();
    }

    public function render()
    {
        $students = $this->getStudents();
        return view('front.components.student-list', compact('students'));
    }


    private function getStudents()
    {
        $query = Student::query();


        return $query->paginate(30);
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
