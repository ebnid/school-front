<div class="bg-white rounded-md mx-auto px-10 py-12">
    <div class="space-y-5">
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

        <div>
            <label for="teacher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teacher</label>
            <select wire:model.debounce="teacher" id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Choose a Teacher</option>
                @foreach($teachers ?? [] as $teacher)
                    <option value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if(count($attendances) > 0)
        <div class="py-10 flex justify-end">
            <a href="" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Print</a>
        </div>

        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Day
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clock In
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clock Out
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Late
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Worktime
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Absent
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ ++$loop->index }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $attendance->name }}
                            </td>
                            <td class="px-6 py-4">
                                @if($attendance->date)
                                    {{ $attendance->date->format('d M Y') }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($attendance->date)
                                    {{ $attendance->date->format('l') }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($attendance->clock_in)
                                    {{ $attendance->clock_in->format('h:i A') }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($attendance->clock_out)
                                    {{ $attendance->clock_out->format('h:i A') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <x-ui.text-loading-spinner wire:loading wire:loading.flex wire:target="teacher, year, month"  loadingText="Loading..."/>
</div>
