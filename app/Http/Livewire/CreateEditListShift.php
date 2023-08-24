<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shift;
use App\Traits\WithSweetAlert;


class CreateEditListShift extends Component
{
    use WithSweetAlert;

    // Form Property
    public $shift_id;
    public $name;
    public $start_at;
    public $end_at;


    // Data List 
    public $shifts = [];


    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'unique:shifts'],
        'start_at' => ['required', 'date_format:H:i'],
        'end_at' => ['required', 'date_format:H:i']
    ];

    protected $listeners = [
        'onShiftDelete' => 'applyDelete'
    ];


    public function mount()
    {
        $this->initData();
    }


    public function render()
    {
        return view('admin.components.create-edit-list-shift');
    }


    public function createShiftHandeler()
    {

        $this->validate();

        try {

            $shift = new Shift();
            
            $shift->name = $this->name;
            $shift->start_at = $this->start_at;
            $shift->end_at = $this->end_at;

            $shift->save();

            $this->resetField();
            $this->initData();

            return $this->success('Successfull', 'New Shift added successfully');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }

    }


    public function updateShiftHandeler()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date_format:H:i'],
            'end_at' => ['required', 'date_format:H:i'],
        ]);

        try {

            $shift = Shift::find($this->shift_id);
            
            $shift->name = $this->name;
            $shift->start_at = $this->start_at;
            $shift->end_at = $this->end_at;

            $shift->save();

            $this->resetField();
            $this->initData();

            return $this->success('Updated', 'Shift updated successfully');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    public function editHandeler($id)
    {
        $shift = Shift::find($id);

        $this->shift_id = $shift->id;
        $this->name = $shift->name;
        $this->start_at = $shift->start_at->format('H:i');
        $this->end_at = $shift->end_at->format('H:i');

    }


    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onShiftDelete', $id, 'Are you sure ?', 'Shift will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Shift::destroy($id);

            $this->initData();
            
            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    private function initData()
    {
        $this->shifts = Shift::latest()->get();
    }


    private function resetField()
    {
        $this->name = null;
        $this->shift_id = null;
        $this->start_at = null;
        $this->end_at = null;
    }
}
