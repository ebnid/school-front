<div class="mx-auto bg-white p-5 md:p-7 relative">

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
                    <option selected value="">Everyone</option>
                    @foreach($employees ?? [] as  $employee)
                        <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
        @elsecanany(['employee'])
            <h3 class="text-3xl text-center font-bold dark:text-white">{{ auth()->user()->name ?? 'Unknown' }}</h3>   
        @endcanany
    </div>


    <!-- List -->
    @if(count($salaries) > 0)
    <div class="relative overflow-x-auto mt-10">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Salary
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bonous
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Overpaid
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Message
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
                @foreach($salaries ?? [] as $salary)
                <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $salary->month_of_salary->format('M Y') }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $salary->employee->user->name ?? '' }}
                    </th>
                    <td class="px-6 py-4">
                        {{ number_format($salary->salary_amount, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ number_format($salary->additional_bonous, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ number_format($salary->overpaid_amount, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Illuminate\Support\Str::limit($salary->message ?? '', 100) }}
                    </td>
                    <td class="px-6 py-4">

                        @if($salary->paid_at)
                            <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Recieved</span>
                        @else 
                            @canany(['employee'])
                                <span wire:click.debounce="confirmRecieved({{ $salary->id }})" class="cursor-pointer bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Confirm Recieved</span>
                            @else 
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending Recieved</span> 
                            @endcanany
                        @endif

                    </td>
                    <td class="px-6 py-4">
                        <div class="">
                            <a target="_blank" href="{{ route('salary.single-details', ['salary_id' => $salary->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Details</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        {{ $salaries->links() }}
    </div>

    @else 
        <h2 class="text-center mt-10">No Results founds !</h2>
    @endif

    <!-- Lading State -->
    <div wire:loading wire:target="confirmRecieved, year, month, employee_id" class="cursor-wait absolute inset-0 w-full h-full" style="background-color: rgba(0,0,0, .6)">
        <div class="absolute left-1/2 -translate-x-1/2 text-white border top-2 rounded-md px-2 py-1">Loading...</div>
    </div>

</div>

@push('modals')
    
@endpush