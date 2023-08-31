<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\Notice;
use App\Traits\WithSweetAlert;

class CreateEditNotice extends Component
{
    use WithSweetAlert;
    use WithPagination;

    public $employees;
    public $is_edit_mode_on = false;
    public $notice_id;


    public $title;
    public $description;
    public $employee_id;


    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:5000'],
        'employee_id' => ['nullable', 'integer']
    ];


    protected $listeners = [
        'onNoticeDelete' => 'applyDelete'
    ];


    public function mount()
    {
        $this->initData();
    }

    public function render()
    {
        $notices = $this->getNotices();
        return view('admin.components.create-edit-notice', compact('notices'));
    }

    public function updateNotice()
    {
        $this->validate();

        try {

            $notice = Notice::find($this->notice_id);

            $notice->title = $this->title;
            $notice->description = $this->description;

            if($this->employee_id){
                $notice->employee_id = $this->employee_id;
            }else {
                $notice->employee_id = null;
            }

            $notice->save();

            $this->title = null;
            $this->description = null;
            $this->employee_id = null;

            $this->is_edit_mode_on = false;

            return $this->success('Saved', ' ');


        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    public function deleteHandeler($id)
    {
        return $this->ifConfirmThenDispatch('onNoticeDelete', $id, 'Are you sure ?', 'Notice will delete permanently !');
    }

    public function applyDelete($id)
    {
        try {

            Notice::destroy($id);

            return $this->success('Deleted', '');

        } catch(\Exception $e){
            return $this->success('Failer', $e->getMessage());
        }
        
    }


    public function cancelEditMode()
    {
        $this->title = null;
        $this->description = null;
        $this->employee_id = null;

        $this->is_edit_mode_on = false;
    }


    public function enableEditMode($id)
    {
        $notice = Notice::find($id);

        $this->title = $notice->title;
        $this->description = $notice->description;
        $this->employee_id = $notice->employee_id;

        $this->notice_id = $notice->id;

        $this->is_edit_mode_on = true;
    }


    public function createNotice()
    {
        $this->validate();

        try {

            $notice = new Notice();

            $notice->title = $this->title;
            $notice->description = $this->description;

            if($this->employee_id){
                $notice->employee_id = $this->employee_id;
            }

            $notice->save();

            $this->reset();

            return $this->success('Created', '');


        }catch(\Exception $e){
            return $this->error('Failer', $e->getMessage());
        }
    }

    private function getNotices()
    {
        return Notice::latest()->paginate(12);
    }
    
    private function initData()
    {
        $this->employees = Employee::with('user')->where('status', 'running')->latest()->get();
    }
}
