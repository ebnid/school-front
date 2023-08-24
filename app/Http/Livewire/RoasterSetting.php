<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Traits\WithSweetAlert;

class RoasterSetting extends Component
{

    use WithSweetAlert;

    public $is_edit_mode_on = false;
    public $employees = [];
    public $employee;


    protected $rules = [
        'employee.prev_employee_id' => ['nullable', 'numeric'],
        'employee.next_employee_id' => ['nullable', 'numeric'],
    ];

    protected $listeners = [
        'onRoasterSetting' => 'preapreRoasterSettingModal'
    ];


    public function render()
    {
        return view('admin.components.roaster-setting');
    }

    public function saveRoaster()
    {
        $this->validate();

        try {

            $this->employee->save();

            $this->reset();

            return $this->success('Saved', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    public function cancelEditMode()
    {
        $this->reset();
    }

    public function preapreRoasterSettingModal($id)
    {
        $this->initData($id);
        $this->employee = Employee::with('user')->find($id);
        $this->is_edit_mode_on = true;
    }


    private function initData($id)
    {
        $this->employees = Employee::where('status', 'running')->whereNotIn('id', [$id])->get();
    }
}
