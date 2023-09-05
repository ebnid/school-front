<?php

namespace App\Http\Livewire\Front;

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

        return view('front.components.notice-list', compact('notices'));
    }


    private function getNotices()
    {

        $search = $this->search;

        $query = Notice::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search);
        });

        return $query->published()->latest()->orderBy('order')->paginate(25);

    }
}