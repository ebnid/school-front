<div>
   @if($is_edit_mode_on)
        <x-custom-modal>
            <div class="bg-white max-w-2xl mx-auto rounded-md mt-10">
                <!-- Header -->
                <div class="p-5 flex justify-between border-b">
                    <h1>Edit {{ $attendance->employee->user->name ?? '' }}</h1>
                    <span wire:click.debounce="cancelEditMode" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>

                <!-- Body -->
                <div class="p-7 max-w-2xl">
                    <!-- Validation errors -->
                    <x-errors />


                    <!-- Late Time & Overtime -->
                    <div class="flex flex-col md:flex-row gap-5 mb-5">   
                        <article
                        class="flex-1 flex items-end justify-between rounded-lg border border-gray-100 bg-white p-6"
                        >
                            <div>
                                <p class="text-sm text-gray-500">Overtime</p>
                                <p class="text-2xl font-medium text-gray-900">
                                    {{ $attendance->overtime ?? 0 }}
                                    <span class="text-xs font-semibold text-gray-500">minutes</span>
                                </p>
                            </div>

                            <div class="inline-flex gap-2 rounded bg-green-100 p-1 text-green-600">
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                                />
                                </svg>

                                <span class="text-xs font-medium"> {{ number_format($attendance->overtimeMoneyAmountPercent(), 2) }}% </span>
                        </div>
                        </article>

                        <article
                        class="flex-1 flex items-end justify-between rounded-lg border border-gray-100 bg-white p-6"
                        >
                            <div>
                                <p class="text-sm text-gray-500">Late</p>

                                <p class="text-2xl font-medium text-gray-900">
                                    {{ $attendance->late_time ?? 0 }}
                                    <span class="text-xs font-semibold text-gray-500">minutes</span>
                                </p>
                            </div>

                            <div class="inline-flex gap-2 rounded bg-red-100 p-1 text-red-600">
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"
                                />
                                </svg>

                                <span class="text-xs font-medium"> {{ number_format($attendance->lateDeductMoneyPercent(), 2) }}% </span>
                            </div>
                        </article>
                    </div>

                    <!-- Form -->
                    <form wire:submit.prevent="updateAttendanceHandeler" class="space-y-5">

                        <div>
                            <div>
                                <label for="early_leave_reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Early Leave Reason</label>
                                <input wire:model.debounce="attendance.early_out_reason" type="text" id="early_leave_reason" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                            </div>
                        </div>

                        <div>
                            <div>
                                <label for="office_in" class="block mb-2 flex gap-3 text-sm font-medium text-gray-900 dark:text-white">
                                    <span>Office In</span>
                                    <div class="flex items-center">
                                        <input wire:model.debounce="is_in_next_day" id="is_in_next_day" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="is_in_next_day" class="ml-1 text-sm font-medium text-gray-900 dark:text-gray-300">Is Next Day</label>
                                    </div>
                                </label>
                                <input wire:model.debounce="in_at" type="time" id="office_in" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                            </div>
                        </div>

                        <div>
                            <div>
                                <label for="out_at" class="block mb-2 text-sm font-medium flex gap-3 text-gray-900 dark:text-white">
                                    <span>Office Out</span>
                                    <div class="flex items-center">
                                        <input wire:model.debounce="is_out_next_day" id="is_out_next_day" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for=is_out_next_day" class="ml-1 text-sm font-medium text-gray-900 dark:text-gray-300">Is Next Day</label>
                                    </div>
                                </label>
                                <input wire:model.debounce="out_at" type="time" id="out_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                            </div>
                        </div>

                    
                        <div>
                            <label for="late_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Late Types</label>
                            <select wire:model.debounce="attendance.late_type" id="late_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a type</option>
                                <option value="{{ \App\Models\Attendance::LATE_TYPE_PAYABLE }}">Payable</option>
                                <option value="{{ \App\Models\Attendance::LATE_TYPE_NON_PAYABLE }}">Non Payable</option>
                            </select>
                        </div>

                        <div>
                            <label for="early_out_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Early Out Types</label>
                            <select wire:model.debounce="attendance.early_out_type" id="early_out_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a type</option>
                                <option value="{{ \App\Models\Attendance::EARLY_OUT_TYPE_PAYABLE }}">Payable</option>
                                <option value="{{ \App\Models\Attendance::EARLY_OUT_TYPE_NON_PAYABLE }}">Non Payable</option>
                            </select>
                        </div>

                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attendances Types</label>
                            <select wire:model.debounce="attendance.type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                            <select wire:model.debounce="attendance.replace_employee_id" id="replace_employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a employee</option>
                                @foreach($employees ?? [] as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="late_cover_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Late Cover Employee</label>
                            <select wire:model.debounce="attendance.late_cover_id" id="late_cover_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a employee</option>
                                @foreach($employees ?? [] as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="overtime_from_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Overtime From Employee</label>
                            <select wire:model.debounce="attendance.overtime_from_id" id="overtime_from_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a employee</option>
                                @foreach($employees ?? [] as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>


                        <x-button  type="submit" >Update</x-button>

                    </form>
                </div>

            </div>
        </x-custom-modal>

        <!-- Loader -->
        <x-loader wire:loading wire:target="cancelEditMode, updateAttendanceHandeler" />
   @endif
</div>
