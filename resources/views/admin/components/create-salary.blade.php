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
            <h3 class="text-3xl text-center font-bold dark:text-white">{{ auth()->user()->name ?? 'Unknown' }}</h3>   
        @endcanany
    </div>


    @if(!$is_already_salary_done)

    <!-- Duties List -->
    @if(count($duties) > 0)
    <div class="mt-8 max-w-4xl mx-auto">
        <h1 class="text-center mb-5">Total Work Days</h1>
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
                            Basic
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Late Deduct
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Early Left Deduct
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Overtime
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Day Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($duties ?? [] as $duty)
                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ++$loop->index  }}
                        </th>
                        <td class="px-6 py-1">
                            {{ $duty->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->dailySalrayAmount(), 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->lateDeductMoneyAmount(), 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->earlyLeaveMoneyDeductAmount(), 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->overtimeMoneyAmount(), 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->todayTotalSalary(), 2) }}
                        </td>
                    </tr>
                    @endforeach

                    <tr class="group font-bold text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Total
                        </th>
                        <td class="px-6 py-1">
                            
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty_total_basic, 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty_total_late_deduct, 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty_total_early_left_deduct, 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty_total_overtime, 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty_total_salary, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif


    <!--Replace Duties List -->
    @if(count($replace_duties) > 0)
    <div class="mt-8 max-w-4xl mx-auto">
        <h1 class="text-center mb-5">Total Replace/Overtime Work Days</h1>
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
                            Basic
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Late Deduct
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Early Left Deduct
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Overtime
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Day Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($replace_duties ?? [] as $duty)
                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ++$loop->index  }}
                        </th>
                        <td class="px-6 py-1">
                            {{ $duty->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->dailySalrayAmount(), 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->lateDeductMoneyAmount(), 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->earlyLeaveMoneyDeductAmount(), 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->overtimeMoneyAmount(), 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($duty->todayTotalSalary(), 2) }}
                        </td>
                    </tr>
                    @endforeach
                
                    <tr class="group font-bold text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Total
                        </th>
                        <td class="px-6 py-1">
                            
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($replace_total_basic, 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($replace_total_late_deduct, 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($replace_total_early_left_deduct, 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($replace_total_overtime, 2) }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($replace_total_salary, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif


    <!--Withdraws List -->
    @if(count($withdraws) > 0)
    <div class="mt-8 max-w-sm mx-auto">
        <h1 class="text-center mb-5">Total Withdraw Amount</h1>
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
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraws ?? [] as $withdraw)
                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ++$loop->index  }}
                        </th>
                        <td class="px-6 py-1">
                            {{ $withdraw->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($withdraw->amount, 2) }}
                        </td>
                    </tr>
                    @endforeach
                
                    <tr class="group font-bold text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Total
                        </th>
                        <td class="px-6 py-1">
                            
                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($withdraw_total_amount, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif


    <!--Withdraws List -->
    @if(count($duties) > 0)
    <div class="mt-8 max-w-sm mx-auto pb-20">
        <h1 class="text-center mb-5">Final Salary</h1>
        <div class="relative overflow-x-auto">
            <table class="whitespace-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Purpose
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            1
                        </th>
                        <td class="px-6 py-1">
                            Duty Salary
                        </td>
                        <td class="px-6 py-1 text-right">
                            {{ number_format($duty_total_salary, 2) }}
                        </td>
                    </tr>

                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            2
                        </th>
                        <td class="px-6 py-1">
                            Replace Duty Salary
                        </td>
                        <td class="px-6 py-1 text-right">
                            {{ number_format($replace_total_salary, 2) }}
                        </td>
                    </tr>

                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            3
                        </th>
                        <td class="px-6 py-1">
                            Withdraw Amount
                        </td>
                        <td class="px-6 py-1 text-right">
                            -{{ number_format($withdraw_total_amount, 2) }}
                        </td>
                    </tr>

                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            4
                        </th>
                        <td class="px-6 py-1">
                            Previous Over Paid
                        </td>
                        <td class="px-6 py-1 text-right">
                            -{{ number_format($total_previous_overpaid, 2) }}
                        </td>
                    </tr>

                    @canany(['admin', 'root'])
                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            5
                        </th>
                        <td class="px-6 py-1">
                            Additional Bonous
                        </td>
                        <td class="px-0 py-1 text-right">
                            <input wire:model.debounce.1000="additional_bonous" style="-webkit-appearance: none; -moz-appearance: textfield;" class="px-1 focus:outline-none rounded-md focus:ring-0 focus:border text-right w-full block h-7" type="number">
                        </td>
                    </tr>
                    @endcanany

                    @if($this_month_overpaid)
                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            6
                        </th>
                        <td class="px-6 py-1">
                            This Month Overpaid
                        </td>
                        <td class="px-6 py-1 text-right">
                            {{ number_format($this_month_overpaid, 2) }}
                        </td>
                    </tr>
                    @endif
                
                    <tr class="group font-bold text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Total
                        </th>
                        <td class="px-6 py-1">

                        </td>
                        <td class="px-6 py-1">
                            {{ number_format($total_monthly_salary, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create Salary BUtton -->
        @canany(['admin', 'root'])
            <div class="mt-10 space-y-5">
                <x-errors />
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Message</label>
                    <textarea wire:model.debounce="message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                </div>

                <div  class="flex justify-center">
                    <x-button wire:click.debounce="createSalary"> Create Salary </x-button>
                </div>
            </div>
        @endcanany
    </div>
    @endif

    @else 
        <h1 class="mb-4 mt-10 text-center text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Sorry ! Salary is already given.</h1>
    @endif


    <!-- Lading State -->
    <div wire:loading wire:target="createSalary, employee_id, year, month" class="cursor-wait absolute inset-0 w-full h-full" style="background-color: rgba(0,0,0, .6)">
        <div class="absolute left-1/2 -translate-x-1/2 text-white border top-2 rounded-md px-2 py-1">Loading...</div>
    </div>

</div>
