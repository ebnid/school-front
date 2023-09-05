<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Announcement;

class CreateAnnouncement extends Component
{
    use WithSweetAlert;

    // From State
    public $announce;
    public $link;
    public $order;
    public $is_published = true;

    protected $rules = [
        'announce' => ['required', 'string', 'max:5000'],
        'link' => ['nullable', 'string', 'max:2048'],
        'order' => ['nullable', 'integer'],
        'is_published' => ['required', 'boolean'],
    ];

    public function render()
    {
        return view('admin.components.create-announcement');
    }


    public function createAnnouncement()
    {
        $this->validate();

        $announcement = new Announcement();

        $announcement->announce = $this->announce;
        $announcement->link = $this->link;
        $announcement->order = $this->order;
        $announcement->is_published = $this->is_published;

        ;

        if(!$announcement->save()) return $this->error('Failed', 'Failed to create Announcement. Try again');

        $this->reset();

        $this->emit('onAnnouncementCreated');
        
        return $this->success('Created', 'Announcement created successfully');
       
    }

}
