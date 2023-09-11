<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Employee;

class CreateEmployee extends Component
{
    use WithSweetAlert;
    use WithFileUploads;

    public $name_bn;
    public $name_en;
    public $mobile_no;
    public $email;
    public $present_address;
    public $permanent_address;
    public $designation;
    public $nid_no;
    public $date_of_birth;
    public $join_date;
    public $current_organization_join_date;
    public $subject;
    public $subject_code;
    public $examinner_code;
    public $training;
    public $term;
    public $bio;
    public $employee_type;
    public $is_published;
    public $image;
    public $old_image;


    protected $rules = [
        'name_en' => ['nullable', 'string', 'max:255'],
        'name_bn' => ['nullable', 'string', 'max:255'],
        'mobile_no' => ['nullable', 'string', 'max:255'],
        'email' => ['nullable', 'email', 'unique:employees'],
        'present_address' => ['nullable', 'string', 'max:2048'],
        'permanent_address' => ['nullable', 'string', 'max:2048'],
        'nid_no' => ['nullable', 'string', 'max:255'],
        'date_of_birth' => ['nullable', 'date'],
        'join_date' => ['nullable', 'date'],
        'current_organization_join_date' => ['nullable', 'date'],
        'subject' => ['nullable', 'string', 'max:255'],
        'subject_code' => ['nullable', 'integer'],
        'examinner_code' => ['nullable', 'integer'],
        'training' => ['nullable', 'string', 'max:255'],
        'designation' => ['nullable', 'string', 'max:255'],
        'term' => ['nullable', 'string', 'max:255'],
        'bio' => ['nullable', 'string', 'max:5000'],
        'employee_type' => ['nullable', 'string', 'max:255'],
        'is_published' => ['nullable', 'boolean'],
    ];


    public function render()
    {
        return view('admin.components.employee.create-employee');
    }


    public function createEmployee()
    {
        $this->validate();

        try {

            $employee = new Employee();

            $employee->name_bn = $this->name_bn;
            $employee->name_en = $this->name_en;
            $employee->mobile_no = $this->mobile_no;
            $employee->email = $this->email;
            $employee->present_address = $this->present_address;
            $employee->permanent_address = $this->permanent_address;
            $employee->designation = $this->designation;
            $employee->nid_no = $this->nid_no;
            $employee->date_of_birth = $this->date_of_birth;
            $employee->join_date = $this->join_date;
            $employee->current_organization_join_date = $this->current_organization_join_date;
            $employee->subject = $this->subject;
            $employee->subject_code = $this->subject_code;
            $employee->examinner_code = $this->examinner_code;
            $employee->training = $this->training;
            $employee->term = $this->term;
            $employee->bio = $this->bio;
            $employee->employee_type = $this->employee_type;
            $employee->is_published = $this->is_published;

            if(!$employee->save()) return $this->error('Failer', '');

            if($this->image){
                $employee->addMedia($this->image)->toMediaCollection('profile');
            }


            $this->reset();
            $this->emit('onEmployeeCreated');
            return $this->success('Added', 'Employee added successfully');


        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }


    public function removeTempProfile()
    {
        $this->image->delete();
        $this->image = null;
    }
}
