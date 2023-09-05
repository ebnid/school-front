<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Announcement;

class EditAnnouncement extends Component
{
    use WithSweetAlert;

    public $is_edit_mode_on = false;

    public $announcement;


    protected $rules = [
        'announcement.announce' => ['required', 'string', 'max:5000'],
        'announcement.link' => ['nullable', 'string', 'max:2048'],
        'announcement.order' => ['nullable', 'integer', ],
        'announcement.is_published' => ['required', 'boolean'],
    ];


    protected $listeners = [
        'onAnnouncementEdit' => 'enableAnnouncementEditMode',
    ];

    public function render()
    {
        return view('admin.components.edit-announcement');
    }

    public function updateAnnouncement()
    {

        $this->validate();

         if($this->announcement->save()){

            $this->reset();

            $this->is_edit_mode_on = false;

            $this->emit('onAnnouncementUpdated');

            return $this->success('Updated', 'Announcement updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableAnnouncementEditMode($id)
    {

        $this->announcement = Announcement::find($id);

        $this->is_edit_mode_on = true;

    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
