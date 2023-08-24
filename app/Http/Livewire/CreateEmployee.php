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



class CreateEmployee extends Component
{

    use WithSweetAlert;

    // Form Property
    public $role = 'employee';
    public $status = 'running';
    public $name;
    public $email;
    public $phone;
    public $password;
    public $confirm;
    public $address;
    public $basic_salary;
    public $shift_id;
    public $designation_id;
    public $organization_id;


    // List Property
    public $shifts = [];
    public $organizations = [];
    public $designations = [];


    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'numeric'],
        'basic_salary' => ['required', 'numeric'],
        'address' => ['nullable', 'string', 'max:255'],
        'organization_id' => ['required', 'numeric'],
        'designation_id' => ['required', 'numeric'],
        'shift_id' => ['required', 'numeric'],
        'password' => ['required', 'string', 'max:255'],
        'status' => ['required', 'in:running,g-out']
    ];

    protected $messages = [

    ];

    protected $listeners = [

    ];


    public function mount()
    {
        $this->initData();
    }

    public function render()
    {
        return view('admin.components.create-employee');
    }


    public function createEmployeeHandeler()
    {

        $this->validate();

        if($this->password != $this->confirm) return $this->error('Error', 'Confirmed Password Not Match With Password !!!');

        try {

            $user = new User();

            $user->name = $this->name;
            $user->password = Hash::make($this->password);
            $user->email = $this->email;
            $user->role = $this->role;

            $user->save();

            $employee = new Employee();

            $employee->phone = $this->phone;
            $employee->address = $this->address;
            $employee->basic_salary = $this->basic_salary;
            $employee->user_id = $user->id;
            $employee->organization_id = $this->organization_id;
            $employee->designation_id = $this->designation_id;
            $employee->shift_id = $this->shift_id;
            $employee->status = $this->status;

            $employee->save();


            $this->resetField();
            $this->initData();

            return $this->success('Employee Added', 'Congratulations, New employee added successfully.');

        } catch(\Exception $e){
            return $this->error('Failer !', $e->getMessage());
        }
    }


    private function resetField()
    {
        $this->reset();
    }


    private function initData()
    {
        $this->organizations = Organization::all();
        $this->designations = Designation::all();
        $this->shifts = Shift::all();
    }

}
