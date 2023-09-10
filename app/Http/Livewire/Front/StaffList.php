<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;


class StaffList extends Component
{
    use WithPagination;

    public $search;


    public function render()
    {
        $staffs = $this->getStaffs();

        return view('front.components.teacher-list', compact('staffs'));
    }

    private function getStaffs()
    {

        $search = $this->search;

        $query = Employee::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name_en', 'like', '%' . $search . '%')->orWhere('name_en', $search);
            $query->where('name_bn', 'like', '%' . $search . '%')->orWhere('name_bn', $search);
        });

        return $query->where('employee_type', 'staff')->paginate(12);
    }
}
