<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class StudentList extends Component
{

    use WithPagination;

    public $years = [];

    // Filter
    public $year;
    public $student_class;
    public $gender;

    public function mount()
    {
        $this->generateYear();
        $this->setDefaultValue();
    }

    public function render()
    {
        $students = $this->getStudents();
        return view('front.components.student-list', compact('students'));
    }


    private function setDefaultValue()
    {
        $this->year = now()->year;
        $this->student_class = null;
        
        if(request()->gender && !empty(request()->gender)){
            if(request()->gender === 'female'){
                $this->gender = 'female';
            }

            elseif(request()->gender === 'male'){
                $this->gender = 'male';
            }
        }
    }

    private function getStudents()
    {
        $year = $this->year;
        $student_class = $this->student_class;
        $gender = $this->gender;


        $query = Student::query();

        $query->when($year, function($query) use($year){
            $query->where('session', $year);
        });

        $query->when($student_class, function($query) use($student_class){
            $query->where('cyear', $student_class);
        });

        $query->when($gender, function($query) use($gender){
            $query->where('sex', $gender);
        });

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
