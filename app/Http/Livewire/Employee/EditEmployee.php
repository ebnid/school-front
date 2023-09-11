<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Employee;
use App\Traits\WithSweetAlert;


class EditEmployee extends Component
{
    use WithSweetAlert;
    use WithFileUploads;

    public $is_edit_mode_on = false;

    public $employee;
    public $image;
    public $old_image;
    public $join_date;
    public $date_of_birth;
    public $current_organization_join_date;


    protected $rules = [
        'employee.name_en' => ['nullable', 'string', 'max:255'],
        'employee.name_bn' => ['nullable', 'string', 'max:255'],
        'employee.mobile_no' => ['nullable', 'string', 'max:255'],
        'employee.email' => ['nullable', 'email'],
        'employee.present_address' => ['nullable', 'string', 'max:2048'],
        'employee.permanent_address' => ['nullable', 'string', 'max:2048'],
        'employee.nid_no' => ['nullable', 'string', 'max:255'],
        'date_of_birth' => ['nullable', 'date'],
        'join_date' => ['nullable', 'date'],
        'current_organization_join_date' => ['nullable', 'date'],
        'employee.subject' => ['nullable', 'string', 'max:255'],
        'employee.subject_code' => ['nullable', 'integer'],
        'employee.examinner_code' => ['nullable', 'integer'],
        'employee.training' => ['nullable', 'string', 'max:255'],
        'employee.designation' => ['nullable', 'string', 'max:255'],
        'employee.term' => ['nullable', 'string', 'max:255'],
        'employee.bio' => ['nullable', 'string', 'max:5000'],
        'employee.employee_type' => ['nullable', 'string', 'max:255'],
        'employee.is_published' => ['nullable', 'boolean'],
    ];



    protected $listeners = [
        'onEmployeeEdit' => 'enableEmployeeEditMode',
    ];

    public function render()
    {
        return view('admin.components.employee.edit-employee');
    }

    public function saveEmployee()
    {

        $this->validate();

        $this->employee->join_date = $this->join_date;
        $this->employee->date_of_birth = $this->date_of_birth;
        $this->employee->current_organization_join_date = $this->current_organization_join_date;

         if($this->employee->save()){

            if($this->image){
                $this->employee->addMedia($this->image)->toMediaCollection('profile');
            }

            $this->reset();

            $this->is_edit_mode_on = false;

            $this->emit('onEmployeeUpdated');

            return $this->success('Updated', 'Employee updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableEmployeeEditMode($id)
    {

        $this->employee = Employee::find($id);
        $this->join_date = $this->employee->join_date->format('Y-m-d');
        $this->date_of_birth = $this->employee->date_of_birth->format('Y-m-d');
        $this->current_organization_join_date = $this->employee->current_organization_join_date->format('Y-m-d');
        $this->old_image = $this->employee->profileUrl();
        $this->is_edit_mode_on = true;

    }


    public function removeTempProfile()
    {
        $this->image->delete();
        $this->image = null;
    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
