<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Notice;

class NoticeList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onNoticeCreated' => '$refresh',
        'onNoticeUpdated' => '$refresh',
        'onNoticeDelete' => 'deleteNotice',
    ];


    public function render()
    {
        $notices = $this->getNotices();

        return view('admin.components.notice-list', compact('notices'));
    }


    public function enableNoticeEditMode($id)
    {
        $this->emit('onNoticeEdit', $id);
    }


    public function confirmDeleteNotice($id)
    {
        return $this->ifConfirmThenDispatch('onNoticeDelete', $id, 'Are you sure ?', 'Notice will delete permanently !');
    }


    public function deleteNotice($id)
    {
        if(Notice::destroy($id)){
            return $this->success('Success', 'Notice deleted successfully.');
        }

        return $this->error('Failed', 'Failed to delete Notice. try again');
    }


    private function getNotices()
    {

        $search = $this->search;

        $query = Notice::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search);
        });

        return $query->latest()->orderBy('order')->paginate(25);

    }
}
