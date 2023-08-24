<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\Designation;
use App\Models\Organization;
use App\Models\Shift;
use App\Models\Employee;
use App\Models\User;
use App\Traits\WithSweetAlert;

class EditEmployee extends Component
{
    use WithSweetAlert;

    public $is_edit_mode_on = false;


    public $organizations = [];
    public $designations = [];
    public $shifts = [];
    public $employees = [];

    // Form Property
    public $new_password;
    public $password_confirm;

    public $user;
    public $employee;


    protected $rules = [
        'user.name' => ['required', 'string', 'max:255'],
        'user.email' => ['required', 'email', 'max:255'],
        'user.role' => ['required', 'in:root,admin,employee', 'max:255'],
        'employee.phone' => ['required', 'numeric'],
        'employee.address' => ['nullable', 'string', 'max:255'],
        'employee.basic_salary' => ['required', 'numeric'],
        'employee.organization_id' => ['required', 'numeric'],
        'employee.designation_id' => ['required', 'numeric'],
        'employee.shift_id' => ['required', 'numeric'],
        'employee.status' => ['required', 'in:running,go-out'],
    ];

    protected $listeners = [
        'onEmployeeEdit' => 'preparedEditModal'
    ];


    public function render()
    {
        return view('admin.components.edit-employee');
    }


    public function updateEmployeeHandeler()
    {
        $this->validate();

        try {

            if($this->new_password){

                if($this->new_password === $this->password_confirm){
                    $this->user->password = Hash::make($this->new_password);
                }else {
                    return $this->error('Validation Error !', 'Password and confirm password does not match !');
                }   

            }

            $this->user->save();
            $this->employee->save();

            $this->emit('employeeUpdated');

            $this->reset();

            $this->is_edit_mode_on = false;

            return $this->success('Updated', '');

        }catch(\Exception $e)
        {
            return $this->error('Failer', $e->getMessage());
        }
    }

    public function cancelEditMode()
    {
        $this->reset();
    }

    public function preparedEditModal($id)
    {

        $this->initData();

        $this->employee = Employee::find($id);
        $this->user = User::find($this->employee->user_id);

        $this->is_edit_mode_on = true;
    }

    private function initData()
    {
        $this->organizations = Organization::all();
        $this->designations = Designation::all();
        $this->shifts = Shift::all();
        $this->employees = Employee::where('status', 'active')->get();
    }
}
