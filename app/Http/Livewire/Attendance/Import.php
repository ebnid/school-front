<?php

namespace App\Http\Livewire\Attendance;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Imports\AttendanceImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Attendance;
use Carbon\Carbon;

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


        $result = $this->checkIsAlreadyImported();

        if($result['is_already_exists_any_row']){
            return $this->error('Data already exists', "Total row {$result['total_row']} and already exists {$result['exists_row']}");
        }

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
        $attendances = Excel::toArray(null, $this->file)[0];

        $totalRow = count($attendances);

        $isAlreadyExistsCountRow = 0;

        foreach($attendances as $index => $attendance){

            if($index === 0) continue;

            $exists =  Attendance::where('name', $attendance[1])->whereDate('date', Carbon::createFromFormat('m/d/Y', $attendance[2])->format('Y-m-d'))->exists();
           
            if($exists){
                $isAlreadyExistsCountRow++;
            }

        }


        if(!$isAlreadyExistsCountRow) {
            return [
                'is_already_exists_any_row' => false,
            ];
        }

        return [
            'is_already_exists_any_row' => true,
            'total_row' => $totalRow,
            'exists_row' => $isAlreadyExistsCountRow
        ];

    }
}
