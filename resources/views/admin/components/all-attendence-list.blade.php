<div class="bg-white p-5 md:p-7 relative">

    <!-- Filter option -->
    <div class="grid gap-5 grid-cols-1 md:grid-cols-3 ">
        <div>
            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
            <select wire:model.debounce="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Choose a year</option>
                @foreach($years ?? [] as $year)
                    <option value="{{ $year }}">{{ $year ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="ymonthear" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Month</label>
            <select wire:model.debounce="month" id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Choose a month</option>
                @foreach($months ?? [] as $index => $month)
                    <option value="{{ ++$index }}">{{ $month ?? '' }}</option>
                @endforeach
            </select>
        </div>

        @canany(['admin', 'root'])
            <div>
                <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee</label>
                <select wire:model.debounce="employee_id" id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose a employee</option>
                    @foreach($employees ?? [] as  $employee)
                        <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
        @elsecanany(['employee'])
            <h3 class="text-3xl text-center font-bold dark:text-white">{{ $employee->user->name ?? 'Unkonw' }}</h3>   
        @endcanany
    </div>

    <!-- Attendances List -->
    <div class="mt-8">
        <div class="relative overflow-x-auto">
            <table class="whitespace-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="x-6 py-3">
                            #
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Shift
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Office In
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Office Out
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Overtime
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Salary
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances ?? [] as $attendance)
                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ++$loop->index  }}
                        </th>
                        <td class="px-6 py-2">

                            <div class="flex flex-col justify-center items-center gap-1">
                                <span class="bg-purple-100 text-purple-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">{{ $attendance->created_at->format('d M Y') }}</span>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $attendance->getStatus() }}</span>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{  $attendance->employee->user->name ?? '' }}
                        </th>
                        <td class="px-6 py-2">
                            <div class="flex flex-col justify-center items-center gap-1">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-1 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $shift->name ?? '' }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $shift->start_at->format('h:i A') ?? 0 }} to {{ $shift->end_at->format('h:i A') ?? 0 }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-2">
                            <div class="flex flex-col justify-center items-center gap-1">
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">{{ $attendance->in_at->format('h:i A') }}</span>
                                @if($attendance->late_time)
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Lates {{ $attendance->late_time ?? 0 }} minutes</span>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">-{{ number_format($attendance->lateDeductMoneyPercent(), 2) }}%</span>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">BDT -{{ number_format($attendance->lateDeductMoneyAmount(), 2) }}</span>
                                    
                                    @if($attendance->late_type === \App\Models\Attendance::LATE_TYPE_PAYABLE)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Payable</span>
                                    @else 
                                        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Non Payable</span>
                                    @endif

                                    @if($attendance->lateCoverEmployee)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Cover by {{ $attendance->lateCoverEmployee->user->name ?? '' }}</span>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-2">
                            @if($attendance->out_at ?? false)
                                <div class="flex flex-col justify-center items-center gap-1">
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">{{ $attendance->out_at->format('h:i A') }}</span>
                                    @if($attendance->early_out_time)
                                        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Early {{ $attendance->early_out_time ?? 0 }} minutes</span>
                                        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">-{{ number_format($attendance->earlyLeaveMoneyDeductPercent(), 2) }}%</span>
                                        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">BDT -{{ number_format($attendance->earlyLeaveMoneyDeductAmount(), 2) }}</span>
                                    @endif
                                </div>
                            @else 
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Unfinished</span>
                            @endif
                        </td>
                        <td class="px-6 py-2">
                            @if($attendance->overtime() ?? false)
                                <div class="flex flex-col justify-center items-center gap-1">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $attendance->overtime }} minutes</span>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">+{{ number_format($attendance->overtimeMoneyAmountPercent(), 2) }}%</span>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">BDT +{{ number_format($attendance->overtimeMoneyAmount(), 2) }}</span>
                                    @if($attendance->overtimeFromEmploye)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">From {{ $attendance->overtimeFromEmploye->user->name ?? '' }}</span>
                                    @endif
                                </div>
                            @else 
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">N/A</span>
                            @endif
                        </td>
                        <td class="px-6 py-2">
                            <div class="flex flex-col justify-center items-center gap-1">
                                @if($attendance->in_at && $attendance->out_at)
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">Basic BDT +{{ number_format($attendance->dailySalrayAmount(), 2) }}</span>
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">+{{ number_format($attendance->dailySalrayAmount(), 2) }} +{{ number_format($attendance->overtimeMoneyAmount(), 2) }} -{{ number_format($attendance->lateDeductMoneyAmount(), 2) }} -{{ number_format($attendance->earlyLeaveMoneyDeductPercent(), 2) }} = {{ number_format($attendance->todayTotalSalary(), 2) }}</span>
                                @else 
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">N/A</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-2">
                            <div class="group-hover:block hidden">
                                @canany(['root', 'admin'])
                                    <button wire:click.debounce="editHandeler({{ $attendance->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                @endcanany

                                @canany(['root'])
                                    <button wire:click.debounce="deleteHandeler({{ $attendance->id }})" >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                @endcanany
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Lading State -->
    <div wire:loading class="cursor-wait absolute inset-0 w-full h-full" style="background-color: rgba(0,0,0, .6)">
        <div class="absolute left-1/2 -translate-x-1/2 text-white border top-2 rounded-md px-2 py-1">Loading...</div>
    </div>

</div>


@push('modals')
    <livewire:edit-attendance />
@endpush