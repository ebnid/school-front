<div class="bg-white rounded-md mx-auto px-10 py-12">
    <div class="space-y-5">
        <div>
            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
            <select wire:model.debounce="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Choose a year</option>
                @foreach($years ?? [] as $_year)
                    <option value="{{ $_year }}">{{ $_year ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="ymonthear" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Month</label>
            <select wire:model.debounce="month" id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Choose a month</option>
                @foreach($months ?? [] as $index => $_month)
                    <option value="{{ ++$index }}">{{ $_month ?? '' }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if(true)
        <div class="py-10 flex justify-end">
            <a href="{{ route('attendances.print-summary', ['year' => $year, 'month' => $month]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Print</a>
        </div>
    @endif
    <x-ui.text-loading-spinner wire:loading wire:loading.flex wire:target="year, month"  loadingText="Loading..."/>
</div>
