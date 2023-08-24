<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Withdraw;
use App\Traits\WithSweetAlert;

class WithdrawRequestCreate extends Component
{

    use WithSweetAlert;

    public $amount;
    public $message;
    public $employee_id;


    
    protected $rules = [
        'amount' => ['required', 'numeric'],
        'employee_id' => ['required', 'numeric'],
        'message' => ['nullable', 'string', 'max:255']
    ];

    public function mount()
    {
        $this->employee_id = auth()->user()->employee->id;
    }

    public function render()
    {
        return view('admin.components.withdraw-request-create');
    }


    public function createWithdrawRequest()
    {
        $this->validate();

        try {

            $withdraw = new Withdraw();

            $withdraw->amount = $this->amount;
            $withdraw->message = $this->message;
            $withdraw->employee_id = $this->employee_id;

            $this->emit('onRefreshWithdrawList');

            $this->amount = null;
            $this->message = null;

            $withdraw->save();
            
            return $this->success('Submited', '');

        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

}
