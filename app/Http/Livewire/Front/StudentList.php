<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Student;

class StudentList extends Component
{

    public function mount()
    {
        dd(Student::paginate(5));
    }

    public function render()
    {
        return view('front.components.student-list');
    }
}
