<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Attendance;
use App\Models\Employee;

class FakeAttendance extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        $year = 2023;

        $months = [
            '1' => range(1, 31),
            '2' => range(1, 28), // Not considering leap years for simplicity
            '3' => range(1, 31),
            '4' => range(1, 30),
            '5' => range(1, 31),
            '6' => range(1, 30),
            '7' => range(1, 31),
            '8' => range(1, 31),
            '9' => range(1, 30),
            '10' => range(1, 31),
            '11' => range(1, 30),
            '12' => range(1, 31),
        ];
        
        $employees = Employee::with('shift')->get();

        foreach($employees as $employee){
            
            foreach($months as $monthNum => $month){

                foreach($month as $day){

                    $lateTime =  $faker->numberBetween(1, 60);
                    $overTime =  $faker->numberBetween(1, 120);
                    $earlyLeaveTime =  $faker->numberBetween(1, 120);

                    $randomLateDays = [9, 12, 19, 25, 28];
                    $randomEarlyDays = [4, 7, 13, 21, 27];
                    $randomFriDays = [1, 6, 15, 25];

                    $date = "{$year}-{$monthNum}-{$day}";              


                    $attendance = new Attendance();

                    $attendance->in_at = $date . " " . $employee->shift->start_at->format('h:i:s');
                    
                    $attendance->out_at = $date . " " . $employee->shift->end_at->addMinutes($overTime)->format('H:i:s');
                    
                    $attendance->overtime = $overTime;

                    $attendance->employee_id = $employee->id;

                    if(in_array($day, $randomLateDays)){
                        $attendance->in_at = $date ." ". $employee->shift->start_at->addMinutes($lateTime)->format('H:i:s');
                        $attendance->late_time = $lateTime;
                        $attendance->late_type = 'non-payable';
                    }

                    elseif(in_array($day, $randomEarlyDays)){
                        $attendance->out_at = $date . " " . $employee->shift->end_at->subMinutes($earlyLeaveTime)->format('H:i:s');
                        $attendance->early_out_time = $earlyLeaveTime;
                        $attendance->early_out_type = 'non-payable';
                    }

                    elseif(in_array($day, $randomFriDays)){
                        $attendance->in_at = $date . " ". $employee->shift->start_at->format('H:i:s');
                        $attendance->out_at = $date . " " .$employee->shift->end_at->format('H:i:s');
                        $attendance->type = 'off-day';
                    }

                    // $attendance->save();

                    $attendance->created_at = $date . " " . now()->format('H:i:s');

                    $attendance->save();

                }

            }

        }
    }


}
