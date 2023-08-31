<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notice;

class NoticeBoard extends Component
{
    public $notice;

    public function mount()
    {
        $this->notice = $this->getLatestNotice();
    }

    public function render()
    {
        $my_notices = $this->getMyNotices();
        $everyone_notices = $this->getEveryoneNotices();
        return view('admin.components.notice-board', compact('my_notices', 'everyone_notices'));
    }

    public function activeNotice($id)
    {
        $this->notice = Notice::find($id);
    }

    private function getLatestNotice()
    {
        return  Notice::where('employee_id', null)->orWhere('employee_id', auth()->user()->employee->id)->latest()->first();
    }

    private function getMyNotices()
    {
        return Notice::where('employee_id', auth()->user()->employee->id)->latest()->take(6)->get();
    }

    private function getEveryoneNotices()
    {   
        return Notice::where('employee_id', null)->latest()->take(6)->get();
    }
}
