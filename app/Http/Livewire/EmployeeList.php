<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\User;
use App\Traits\WithSweetAlert;

class EmployeeList extends Component
{

    use WithSweetAlert;
    use WithPagination;

    public $per_page = 12;
    public $search;


    protected $listeners = [
        'onEmployeeDelete' => 'applyDelete',
        'employeeUpdated' => '$refresh',
    ];

    public function render()
    {
        $employees = $this->getEmployees();
        return view('admin.components.employee-list', compact('employees'));
    }


    public function editHandeler($id)
    {
        return $this->emit('onEmployeeEdit', $id);
    }

    public function roasterSettingHandeler($id)
    {
        return $this->emit('onRoasterSetting', $id);
    }


    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onEmployeeDelete', $id, 'Are you sure ?', 'Employee will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            $user_id;

            $employee = Employee::find($id);

            $user_id = $employee->user_id;

            $employee->delete();

            User::destroy($user_id);

            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    private function getEmployees()
    {
        $query = Employee::with('user');

        $search_term = $this->search;

        $query->when($search_term, function($query) use($search_term){
            $query->whereHas('user', function($query) use($search_term){
                $query->where('name', 'like', '%' . $search_term . '%')
                      ->orWhere('name', $search_term)
                      ->orWhere('email', 'like', '%' . $search_term . '%')
                      ->orWhere('email', $search_term);
            });
        });


        return $query->paginate($this->per_page);
    }
}
