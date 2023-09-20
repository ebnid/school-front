<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;

class Import extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $file;


    protected $rules = [
        'file' => ['required', 'file', 'mimes:xls,xlsx,csv', 'max:2048']
    ];


    public function render()
    {
        return view('admin.components.attendance.import');
    }



    public function startImport()
    {
        $this->validate();
    }


    public function removeTempFile()
    {
        $this->file->delete();
        $this->file = null;
    }
}
