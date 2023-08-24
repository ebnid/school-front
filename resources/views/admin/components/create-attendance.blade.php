<div>
    <div class="bg-white max-w-2xl rounded-md">

        <div class="p-7 max-w-2xl">
            <!-- Validation errors -->
            <x-errors />

            <!-- Form -->
            <form wire:submit.prevent="createAttendanceHandeler" class="space-y-5">

                <div>
                    <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attendace Owner</label>
                    <select wire:model.debounce="employee_id" id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Choose a employee</option>
                        @foreach($employees ?? [] as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div>
                        <label for="attendance_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attendance Date</label>
                        <input wire:model.debounce="attendance_date" type="date" id="attendance_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    </div>
                </div>

                <div>
                    <div>
                        <label for="early_leave_reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Early Leave Reason (if has)</label>
                        <input wire:model.debounce="early_out_reason" type="text" id="early_leave_reason" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    </div>
                </div>

                <div>
                    <div>
                        <label for="office_in" class="block mb-2 flex gap-3 text-sm font-medium text-gray-900 dark:text-white">
                            <span>Office In</span>
                        </label>
                        <input wire:model.debounce="in_at" type="datetime-local" id="office_in" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    </div>
                </div>

                <div>
                    <div>
                        <label for="late_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Late Time (if has)</label>
                        <input wire:model.debounce="late_time" type="number" id="late_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    </div>
                </div>


                <div>
                    <label for="late_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Late Types (if has late time)</label>
                    <select wire:model.debounce="late_type" id="late_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Choose a type</option>
                        <option value="{{ \App\Models\Attendance::LATE_TYPE_PAYABLE }}">Payable</option>
                        <option value="{{ \App\Models\Attendance::LATE_TYPE_NON_PAYABLE }}">Non Payable</option>
                    </select>
                </div>

                <div>
                    <div>
                        <label for="out_at" class="block mb-2 text-sm font-medium flex gap-3 text-gray-900 dark:text-white">
                            <span>Office Out</span>
                        </label>
                        <input wire:model.debounce="out_at" type="datetime-local" id="out_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    </div>
                </div>

                <div>
                    <div>
                        <label for="early_out_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Early Out Time (if has)</label>
                        <input wire:model.debounce="early_out_time" type="number" id="early_out_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    </div>
                </div>
            
                <div>
                    <label for="early_out_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Early Out Types (if has Early Out Time)</label>
                    <select wire:model.debounce="early_out_type" id="early_out_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Choose a type</option>
                        <option value="{{ \App\Models\Attendance::EARLY_OUT_TYPE_PAYABLE }}">Payable</option>
                        <option value="{{ \App\Models\Attendance::EARLY_OUT_TYPE_NON_PAYABLE }}">Non Payable</option>
                    </select>
                </div>

                <div>
                    <div>
                        <label for="overtime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Overtime (if has)</label>
                        <input wire:model.debounce="overtime" type="number" id="overtime" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    </div>
                </div>

                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attendances Types</label>
                    <select wire:model.debounce="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Choose a type</option>
                        <option value="{{ \App\Models\Attendance::ATTENDANCE_OFF_DAY }}">Off Day</option>
                        <option value="{{ \App\Models\Attendance::ATTENDANCE_PRESENT }}">Present</option>
                        <option value="{{ \App\Models\Attendance::ATTENDANCE_ABSENT }}">Absent</option>
                        <option value="{{ \App\Models\Attendance::ATTENDANCE_REPLACE }}">Replace</option>
                        <option value="{{ \App\Models\Attendance::ATTENDANCE_PAY_LEAVE }}">Payable Leave</option>
                        <option value="{{ \App\Models\Attendance::ATTENDANCE_NO_PAY_LEAVE }}">Non Payable Leave</option>
                    </select>
                </div>

                <div>
                    <label for="replace_employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Replace Employee</label>
                    <select wire:model.debounce="replace_employee_id" id="replace_employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Choose a employee</option>
                        @foreach($employees ?? [] as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="late_cover_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Late Cover Employee</label>
                    <select wire:model.debounce="late_cover_id" id="late_cover_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Choose a employee</option>
                        @foreach($employees ?? [] as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="overtime_from_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Overtime From Employee</label>
                    <select wire:model.debounce="overtime_from_id" id="overtime_from_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Choose a employee</option>
                        @foreach($employees ?? [] as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>


                <x-button  type="submit" >Create</x-button>

            </form>
        </div>

    </div>

    <!-- Loader -->
    <x-loader wire:loading wire:target="createAttendanceHandeler" />
</div>
