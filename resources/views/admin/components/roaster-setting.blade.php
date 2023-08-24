<div>
   @if($is_edit_mode_on)
        <x-custom-modal>
            <div class="bg-white max-w-2xl mx-auto rounded-md mt-10">
                <!-- Header -->
                <div class="p-5 flex justify-between border-b">
                    <h1>{{ $employee->user->name ?? '' }}</h1>
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

                    <!-- Form -->
                    <form wire:submit.prevent="saveRoaster" class="space-y-5">

                        <div>
                            <label for="prev_employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prevous Employee</label>
                            <select wire:model.debounce="employee.prev_employee_id" id="prev_employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a previous employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="next_employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Next Employee</label>
                            <select wire:model.debounce="employee.next_employee_id" id="next_employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a next employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-button  type="submit" >Save</x-button>

                    </form>
                </div>

            </div>
        </x-custom-modal>

        <!-- Loader -->
        <x-loader wire:loading wire:target="cancelEditMode, saveRoaster" />
   @endif
</div>
