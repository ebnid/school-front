<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class TeacherList extends Component
{

    use WithPagination;

    public $search;


    public function render()
    {
        $teachers = $this->getTeachers();

        return view('front.components.teacher-list', compact('teachers'));
    }

    private function getTeachers()
    {

        $search = $this->search;

        $query = Employee::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name_en', 'like', '%' . $search . '%')->orWhere('name_en', $search);
            $query->where('name_bn', 'like', '%' . $search . '%')->orWhere('name_bn', $search);
        });

        return $query->paginate(25);

    }
}
