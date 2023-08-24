<div class="bg-white p-5 md:p-7 flex gap-5">

    <div class="w-3/5 relative overflow-x-auto ">
        <div class="pb-4 bg-white dark:bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:model.debounce="search" type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search">
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input wire:click.debounce="toggleBulkSelect" id="bulk-select" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bulk-select" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Employee Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Shift
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees ?? [] as $employee)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input wire:model.debounce="select_employees" value="{{ $employee->id }}" id="employee-{{ $loop->index }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="employee-{{ $loop->index }}" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $employee->user->name ?? '' }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $employee->shift->name ?? '' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $employee->shift->start_at->format('h:i: A') }} to {{ $employee->shift->end_at->format('h:i: A') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="w-2/5 p-5 md:p-12">
        <x-errors />
        <div class="space-y-5">
            <div>
                <label for="leave_start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leave Start</label>
                <input wire:model.debounce="leave_start" type="date" id="leave_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>

            <div>
                <label for="leave_end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leave End</label>
                <input wire:model.debounce="leave_end" type="date" id="leave_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>

            <div>
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leaves Types</label>
                <select wire:model.debounce="leave_type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose a type</option>
                    <option value="{{ \App\Models\Attendance::ATTENDANCE_OFF_DAY }}">Off Day</option>
                    <option value="{{ \App\Models\Attendance::ATTENDANCE_PRESENT }}">Present</option>
                    <option value="{{ \App\Models\Attendance::ATTENDANCE_ABSENT }}">Absent</option>
                    <option value="{{ \App\Models\Attendance::ATTENDANCE_REPLACE }}">Replace</option>
                    <option value="{{ \App\Models\Attendance::ATTENDANCE_PAY_LEAVE }}">Payable Leave</option>
                    <option value="{{ \App\Models\Attendance::ATTENDANCE_NO_PAY_LEAVE }}">Non Payable Leave</option>
                </select>
            </div>

            <div class="flex justify-end">
                <x-button wire:click.debonce="createLeave">
                    <span wire:loading.remove wire:target="createLeave">Confirm</span>
                    <span wire:loading wire:target="createLeave">Proccesing...</span>
                </x-button>
            </div>
        </div>
    </div>

</div>
