<div class="bg-white rounded-md mx-auto px-10 py-12">
    <h1 class="text-2xl font-bold mb-5">Delete Attendances</h1>
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

    @if($is_has_report)
        <div class="py-10 flex justify-center">
           <x-button wire:click.debounce="startDelete" type="button">Start Deleting</x-button>
        </div>
    @else 
    <div class="p-4 mb-4 mt-10 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
        <span class="font-medium">There is no reports found on this date!</span>
    </div>
    @endif
    <x-ui.text-loading-spinner wire:loading wire:loading.flex wire:target="startDelete, year, month"  loadingText="Loading..."/>
</div>
