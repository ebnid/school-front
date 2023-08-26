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


    <!--Overtimes List -->
    @if(count($overtimes) > 0)
    <div class="mt-8 max-w-4xl mx-auto">
        <h1 class="text-center mb-5">Overtimes</h1>
        <div class="relative overflow-x-auto">
            <table class="whitespace-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="x-6 py-3">
                            Date
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Start 
                        </th>

                        <th scope="col" class="px-6 py-3">
                            End
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Overtime
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($overtimes ?? [] as $overtime)
                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $overtime->created_at->format('d M Y') }}
                        </th>
                        <td class="px-6 py-1">
                            {{ auth()->user()->name ?? '' }}
                        </td>
                        <td class="px-6 py-1">
                            
                        </td>
                        <td class="px-6 py-1">
                            
                        </td>
                        <td class="px-6 py-1">
                            
                        </td>
                        <td class="px-6 py-1">
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif


    <!-- Lading State -->
    <div wire:loading wire:target="createSalary, employee_id, year, month" class="cursor-wait absolute inset-0 w-full h-full" style="background-color: rgba(0,0,0, .6)">
        <div class="absolute left-1/2 -translate-x-1/2 text-white border top-2 rounded-md px-2 py-1">Loading...</div>
    </div>

</div>
