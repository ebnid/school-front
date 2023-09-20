<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Imports\AttendanceImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Model\Attendance;

class Import extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $file;


    protected $rules = [
        'file' => ['required', 'file', 'mimes:xlsx,csv', 'max:2048']
    ];


    public function render()
    {
        return view('admin.components.attendance.import');
    }



    public function startImport()
    {
        $this->validate();


        dd($this->checkIsAlreadyImported());

        try {


            $attendanceImporter = new AttendanceImport;

            $attendanceImporter->import($this->file); 

            $this->file->delete();

            $this->file = null;

            return $this->success('Imported Successfully', '');

        }catch(\Exception $e){
            return $this->error('Failer', 'Imported failed connect to Developer');
        }


    }

    public function removeTempFile()
    {
        $this->file->delete();
        $this->file = null;
    }


    private function checkIsAlreadyImported()
    {
        $attendances = Excel::toArray(null, $this->file);

        $isAlreadyExistsAnyRow = false;
        
        foreach($attendances as $attendance){

        }

    }
}
