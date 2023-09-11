<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Employee;

class EmployeeList extends Component
{


    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onEmployeeCreated' => '$refresh',
        'onEmployeeUpdated' => '$refresh',
        'onEmployeeDelete' => 'deleteEmployee',
    ];


    public function render()
    {
        $employees = $this->getEmployees();

        return view('admin.components.employee.employee-list', compact('employees'));
    }


    public function enableEmployeeEditMode($id)
    {
        return $this->emit('onEmployeeEdit', $id);
    }

    public function openEducationList($id)
    {
        return $this->emit('onOpenEducationList', $id);
    }


    public function confirmDeleteEmployee($id)
    {
        return $this->ifConfirmThenDispatch('onEmployeeDelete', $id, 'Are you sure ?', 'Employee will delete permanently !');
    }


    public function deleteEmployee($id)
    {
        try {
            Employee::destroy($id);
            return $this->success('Success', 'Employee deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete Employee. try again');
        }

    }

    public function openSlideList($EmployeeId)
    {
        $this->emit('onOpenSlideList', $EmployeeId);
    }


    private function getEmployees()
    {

        $search = $this->search;

        $query = Employee::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name_en', 'like', '%' . $search . '%')->orWhere('name_en', $search);
        });

        return $query->paginate(25);

    }
}
