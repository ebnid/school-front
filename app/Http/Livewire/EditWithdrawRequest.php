<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Withdraw;
use App\Traits\WithSweetAlert;

class EditWithdrawRequest extends Component
{

    use WithSweetAlert;

    public $is_edit_mode_on = false;
    public $withdraw;

    protected $rules = [
        'withdraw.amount' => ['required', 'numeric'],
        'withdraw.message' => ['required', 'string', 'max:2047'],
        'withdraw.status' => ['nullable', 'string', 'max:255']
    ];

    protected $listeners = [
        'onEditWithdraw' => 'preparedWithdrawEditModal'
    ];


    public function render()
    {
        return view('admin.components.edit-withdraw-request');
    }

    public function updateWithdrawRequest()
    {
        $this->validate();

        try {

            $this->withdraw->save();

            $this->emit('onRefreshWithdrawList');

            $this->reset();

            $this->is_edit_mode_on = false;

            return $this->success('Updated', '');

        }catch(\Exception $e)
        {
            return $this->error('Failer', $e->getMessage());
        }
    }

    public function preparedWithdrawEditModal($id)
    {
        $this->withdraw = Withdraw::find($id);
        $this->is_edit_mode_on = true;
    }

    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
