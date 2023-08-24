<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;
use App\Traits\WithSweetAlert;


class CreateEditListOrganization extends Component
{

    use WithSweetAlert;

    // Form Property
    public $organization_id;
    public $name;


    // Data List 
    public $organizations = [];


    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'unique:organizations']
    ];

    protected $listeners = [
        'onOrgDelete' => 'applyDelete'
    ];


    public function mount()
    {
        $this->initData();
    }


    public function render()
    {
        return view('admin.components.create-edit-list-organization');
    }


    public function createOrgHandeler()
    {

        $this->validate();

        try {

            $org = new Organization();
            
            $org->name = $this->name;

            $org->save();

            $this->resetField();
            $this->initData();

            return $this->success('Successfull', 'New organization added successfully');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }

    }


    public function updateOrgHandeler()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        try {

            $org = Organization::find($this->organization_id);
            
            $org->name = $this->name;

            $org->save();

            $this->resetField();
            $this->initData();

            return $this->success('Updated', 'organization updated successfully');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    public function editHandeler($id)
    {
        $org = Organization::find($id);

        $this->organization_id = $org->id;
        $this->name = $org->name;
        
    }


    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onOrgDelete', $id, 'Are you sure ?', 'Organization will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Organization::destroy($id);

            $this->initData();
            
            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    private function initData()
    {
        $this->organizations = Organization::latest()->get();
    }


    private function resetField()
    {
        $this->name = '';
        $this->organization_id = null;
    }

}
