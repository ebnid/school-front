<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Education;

class EducationList extends Component
{
    use WithSweetAlert;

    public $employee_id;
    public $is_education_list_show = false;
    public $is_edit_mode_on = false;
    public $education_id = false;

    public $exam_name;
    public $passing_year;
    public $division_gpa;
    public $board;

    protected $listeners = [
        'onEducationCreated' => '$refresh',
        'onEducationUpdated' => '$refresh',
        'onEducationDelete' => 'deleteEducation',
        'onOpenEducationList' => 'openEducationList',
    ];

    protected $rules = [
        'exam_name' => ['required', 'string', 'max:255'],
        'passing_year' => ['required', 'integer'],
        'division_gpa' => ['required', 'string', 'max:255'],
        'board' => ['required', 'string', 'max:255'],
    ];


    public function render()
    {
        $educations = $this->getEducations();

        return view('admin.components.employee.education-list', compact('educations'));
    }


    public function addEducation()
    {
        $this->validate();


        try {

            $education = new Education();

            $education->exam_name = $this->exam_name;
            $education->passing_year = $this->passing_year;
            $education->division_gpa = $this->division_gpa;
            $education->board = $this->board;
            $education->employee_id = $this->employee_id;
            
            $education->save();

            $this->resetForm();

            return $this->success('Added', '');

        }catch(\Exception $e)
        {
            return $this->error('Failer', $e->getMessage());
        }
    }


    public function enableEditMode($id)
    {
        $education = Education::find($id);

        $this->education_id = $education->id;

        $this->exam_name = $education->exam_name;
        $this->passing_year = $education->passing_year;
        $this->division_gpa = $education->division_gpa;
        $this->board = $education->board;

        $this->is_edit_mode_on = true;
        
    }


    public function updateEducation()
    {
        $this->validate();


        try {

            $education =  Education::find($this->education_id);

            $education->exam_name = $this->exam_name;
            $education->passing_year = $this->passing_year;
            $education->division_gpa = $this->division_gpa;
            $education->board = $this->board;
            
            $education->save();

            $this->resetForm();

            $this->is_edit_mode_on = false;

            return $this->success('Saved', '');

        }catch(\Exception $e)
        {
            return $this->error('Failer', $e->getMessage());
        }
    }


    public function openEducationList($id)
    {
        $this->employee_id = $id;
        $this->is_education_list_show = true;
    }


    public function confirmDelete($id)
    {
        return $this->ifConfirmThenDispatch('onEducationDelete', $id, 'Are you sure ?', 'Education will delete permanently !');
    }


    public function hideModal()
    {
        $this->reset();
        $this->is_education_list_show = false;
    }

    public function cancelEditMode()
    {
        $this->resetForm();
        $this->is_edit_mode_on = false;
    }


    public function enableEducationEditMode($id)
    {
        $this->emit('onEducationEdit', $id);
    }


    public function deleteEducation($id)
    {
        try {
            Education::destroy($id);
            return $this->success('Success', 'Education deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete Education. try again');
        }

    }


    private function getEducations()
    {

        $query = Education::where('employee_id', $this->employee_id);

        return $query->get();

    }

    private function resetForm()
    {
        $this->exam_name = null;
        $this->passing_year = null;
        $this->division_gpa = null;
        $this->board = null;
    }
}
