<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Withdraw;
use App\Traits\WithSweetAlert;

class WithdrawRequestList extends Component
{

    use WithSweetAlert;
    use WithPagination;


    protected $listeners = [
        'onWithdrawDelete' => 'applyDelete',
        'onRefreshWithdrawList' => '$refresh'
    ];


    public function render()
    {
        $withdraws = $this->initData();
        return view('admin.components.withdraw-request-list', compact('withdraws'));
    }


    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onWithdrawDelete', $id, 'Are you sure ?', 'Withdraw will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Withdraw::destroy($id);
            
            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }
    public function editHandeler($id)
    {
        return $this->emit('onEditWithdraw', $id);
    }

    public function initData()
    {
        return Withdraw::with('employee.user')->latest()->paginate(30);
    }
}
