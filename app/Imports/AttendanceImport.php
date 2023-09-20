<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class AttendanceImport implements ToModel, WithHeadingRow, WithValidation
{

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            'name' => $row['name'],
            'date' => Carbon::createFromFormat('n/j/Y', $row['date'])->format('Y-m-d'),
            'clock_in' => $row['clock_in'],
            'clock_out' => $row['clock_out'],
        ]);
    }


    public function rules(): array 
    {
        return [
            '*.date' => ['required', 'date', 'unique:attendances']
        ];
    }
}
