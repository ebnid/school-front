<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Attendance;
use App\Traits\WithSweetAlert;

class GiveAttendence extends Component
{

    use WithSweetAlert;

    // Data Property
    public $employee;
    public $todayAttendance;

    public $tooEarlyTime;
    public $isThisDeviceAllowed = false;

    protected $listeners = [
        'onOfficeExit' => 'applyOfficeExit'
    ];

    public function mount()
    {
        $this->initialSetup();        
    }

    public function render()
    {
        return view('admin.components.give-attendence');
    }


    public function updatedScannerInput($value)
    {
        return $this->dispatchBrowserEvent('scanner:init');
    }


    public function officeInHandeler()
    {

        if($this->checkIsLate()){
            return $this->handleLateOfficeIn();
        }else {
            return $this->handleInTimeOfficeIn();
        }

    }


    private function handleLateOfficeIn()
    {


        try {

            $lateTimeInMinute = $this->countEarlyOrLateMinutes();

            $prevEmployee = $this->employee->prevEmployee;
            $prevEmployeeAttendance = null;

            if($prevEmployee){
                $prevEmployeeAttendance = $prevEmployee->todayAttendance();
            }

            DB::transaction(function () use($lateTimeInMinute, $prevEmployee, $prevEmployeeAttendance){
                
                $attendence = new Attendance();

                $attendence->in_at = now();
                $attendence->late_time = $lateTimeInMinute;
                $attendence->late_type = Attendance::LATE_TYPE_NON_PAYABLE;
                $attendence->employee_id = $this->employee->id;

                if($prevEmployee){
                    $attendence->late_cover_id = $prevEmployee->id;
                }

                $attendence->save();

                if($prevEmployeeAttendance){
                    $prevEmployeeAttendance->overtime_from_id = $this->employee->id;
                    $prevEmployeeAttendance->save();
                }

                $this->exitPreviousEmployeeIfHas($this->employee->id, $lateTimeInMinute);

                $this->initialSetup(); 

                return $this->success('Welcome to Ebnhost LTD.','Your presentation is done !');

            });

        } catch (\Exception $e) {
            return $this->error('Failer', $e->getMessage());
        }

    }

    private function handleInTimeOfficeIn()
    {
        try {

                $attendence = new Attendance();

                $attendence->in_at = now();
                $attendence->employee_id = $this->employee->id;

                $attendence->save();

                $this->exitPreviousEmployeeIfHas($this->employee->id);

                $this->initialSetup(); 

                return $this->success('Welcome to Ebnhost LTD.','Your presentation is done !');

        } catch (\Exception $e) {
            return $this->error('Failer', $e->getMessage());
        }
        
    }



    public function handleOfficeExit()
    {
        return $this->ifConfirmThenDispatch('onOfficeExit', null, 'Are you sure ?', 'If sure then click yes i am !');
    }


    public function applyOfficeExit()
    {
        try {

            $overTimeOrDeductTime = $this->countOverTimeOrEarlyLeftTime();

            if($this->checkIsOvertime()){
                $this->todayAttendance->overtime = $overTimeOrDeductTime;
            }else {
                $this->todayAttendance->early_out_time = $overTimeOrDeductTime;
                $this->todayAttendance->early_out_type = Attendance::EARLY_OUT_TYPE_NON_PAYABLE;
            }

            $this->todayAttendance->out_at = now();

            $this->todayAttendance->save();

            $this->initialSetup(); 

            return $this->success('Thank You','Your office is end today.');

        } catch (\Exception $e) {
            return $this->error('Failer', $e->getMessage());
        }
    }


    private function exitPreviousEmployeeIfHas($employee_id, $overtime = 0)
    {
        $employee = Employee::with('prevEmployee')->find($employee_id);

        $prevEmployee = $employee->prevEmployee;

        if(!$prevEmployee) return;

        $prevEmployeeTodayAttendance = $prevEmployee->todayAttendance();

        if(!$prevEmployeeTodayAttendance) return;

        if($prevEmployeeTodayAttendance->in_at && $prevEmployeeTodayAttendance->out_at) return;

        if(!$overtime){
            $prevEmployeeTodayAttendance->out_at = $prevEmployee->shift->end_at;
        }else {
            $prevEmployeeTodayAttendance->out_at = now();
            $prevEmployeeTodayAttendance->overtime = $overtime;
        }

        $prevEmployeeTodayAttendance->save();
    }

    private function countEarlyOrLateMinutes()
    {
        $shift_start = $this->employee->shift->start_at;
        $current_time = now();

        return $current_time->diffInMinutes($shift_start);
    }

    private function checkIsEarly()
    {
        $shift_start = $this->employee->shift->start_at;
        $current_time = now()->addMinutes(config('setting.allowed_before_minute'));

        return $current_time->lt($shift_start);
    }

    private function checkIsLate()
    {
        $shift_start = $this->employee->shift->start_at;
        $current_time = now();

        return $current_time->gt($shift_start);
    }
    


    private function countOverTimeOrEarlyLeftTime()
    {
        $shift_end = $this->employee->shift->end_at;
        $current_time = now();

        return $current_time->diffInMinutes($shift_end);
    }

    private function checkIsOvertime()
    {
        $shift_end = $this->employee->shift->end_at;
        $current_time = now();

        return $current_time->gt($shift_end);
    }


    private function checkTodayAttendenceStatus()
    {

        // Check Early Time and Set Early time if too early
        if($this->checkIsEarly()){
            $this->tooEarlyTime = $this->countEarlyOrLateMinutes();
        }else {
            $this->tooEarlyTime = null;
        }

        // Check Today Attendance Is Already given or not 
        $this->todayAttendance = $this->employee->todayAttendance();

    }


    private function checkIsThisDeviceAllowed()
    {
        $this->isThisDeviceAllowed = true;
    }


    private function initData()
    {
        $employee = Employee::with('user','shift', 'organization', 'designation', 'prevEmployee', 'nextEmployee')->where('user_id', auth()->id())->first();

        $this->employee = $employee;
    }

    private function initialSetup()
    {
        $this->initData();
        $this->checkTodayAttendenceStatus();
        $this->checkIsThisDeviceAllowed();
    }

}
