<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Leave;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;

class LeaveRequestList extends Component
{

    use WithSweetAlert;
    use WithPagination;

    protected $listeners = [
        'onLeaveDelete' => 'applyDelete',
        'onLeaveRequestRefresh' => '$refresh',
    ];

    public function render()
    {
        $leaves = $this->getLeaves();
        return view('admin.components.leave-request-list', compact('leaves'));
    }


    public function leaveRequestResponseDetail($id)
    {
        return $this->emit('onLeaveRequestResponseDetail', $id);
    }


    private function getLeaves()
    {
        return Leave::latest()->paginate(12);
    }

    public function confirmLeavehandeler($id)
    {
        return $this->emit('onLeaveResponseModalShow', $id);
    }


    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onLeaveDelete', $id, 'Are you sure ?', 'Leave Request will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Leave::destroy($id);

            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }
}
