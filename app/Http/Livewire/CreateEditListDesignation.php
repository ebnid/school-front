<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Designation;
use App\Models\Organization;
use App\Traits\WithSweetAlert;


class CreateEditListDesignation extends Component
{
    use WithSweetAlert;

    // Form Property
    public $designation_id;
    public $organization_id;
    public $name;


    // Data List 
    public $designations = [];
    public $organization = [];


    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'unique:designations'],
        'organization_id' => ['required'] 
    ];

    protected $messages = [
        'name.required' => 'Organization name filed is must required !',
        'organization_id.required' => 'Please select a organizaiton !',
    ];

    protected $listeners = [
        'onDesignationDelete' => 'applyDelete'
    ];


    public function mount()
    {
        $this->initData();
    }


    public function render()
    {
        return view('admin.components.create-edit-list-designation');
    }


    public function createDesignationHandeler()
    {

        $this->validate();

        try {

            $designation = new Designation();
            
            $designation->name = $this->name;
            $designation->organization_id = $this->organization_id;

            $designation->save();

            $this->resetField();
            $this->initData();

            return $this->success('Successfull', 'New Designation added successfully');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }

    }


    public function updateDesignationHandeler()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'organization_id' => ['required']
        ]);

        try {

            $designation = Designation::find($this->designation_id);
            
            $designation->name = $this->name;
            $designation->organization_id = $this->organization_id;

            $designation->save();

            $this->resetField();
            $this->initData();

            return $this->success('Updated', 'Designation updated successfully');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    public function editHandeler($id)
    {
        $designation = Designation::find($id);

        $this->designation_id = $designation->id;
        $this->organization_id = $designation->organization_id;
        $this->name = $designation->name;
        
    }


    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onDesignationDelete', $id, 'Are you sure ?', 'Designation will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Designation::destroy($id);

            $this->initData();
            
            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    private function initData()
    {
        $this->designations = Designation::latest()->get();
        $this->organizations = Organization::all();
    }


    private function resetField()
    {
        $this->name = '';
        $this->designation_id = null;
        $this->organization_id = null;
    }
}
