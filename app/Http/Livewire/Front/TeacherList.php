<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class TeacherList extends Component
{

    use WithPagination;

    public function render()
    {
        $teachers = $this->getTeachers();

        return view('front.components.teacher-list', compact('teachers'));
    }

    private function getTeachers()
    {
        return Employee::where('employee_type', 'teacher')->paginate(12);
    }
}
