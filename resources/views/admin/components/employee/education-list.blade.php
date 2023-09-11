<div>
   @if($is_education_list_show)
        <x-custom-modal>
            <div class="bg-white max-w-2xl mx-auto rounded-md mt-10">
                <!-- Header -->
                <div class="p-5 flex justify-between border-b">
                    <h1>Education</h1>
                    <span wire:click.debounce="hideModal" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>

                <div class="overflow-x-auto z-20 p-7">
                    <table class="w-full whitespace-nowrap text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Exam Name</th>
                                <th scope="col" class="px-4 py-3">Passing Year</th>
                                <th scope="col" class="px-4 py-3">Division/Gpa</th>
                                <th scope="col" class="px-4 py-3">Board</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($educations ?? [] as $education)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $education->exam_name ?? '' }}</td>
                                <td class="px-4 py-3">{{ $education->passing_year ?? '' }}</td>
                                <td class="px-4 py-3">{{ $education->division_gpa ?? '' }}</td>
                                <td class="px-4 py-3">{{ $education->board ?? '' }}</td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end">
                                        <button wire:click.debounce="enableEditMode({{ $education->id }})" class="ml-1" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                        <button wire:click.debounce="confirmDelete({{ $education->id }})" class="ml-1 text-red-400" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Body -->
                <div class="p-7 max-w-2xl mt-5">
                    <!-- Validation errors -->
                    <x-errors />

                    <div class="grid grid-cols-2 gap-5">

                        <div>
                            <x-label for="exam_name" value="{{ __('Exam Name') }}" />
                            <x-input wire:model.debounce="exam_name" id="exam_name" class="block h-8 mt-1 w-full" type="text" />
                        </div>

                        <div>
                            <x-label for="passing_year" value="{{ __('Passing Year') }}" />
                            <x-input wire:model.debounce="passing_year" id="passing_year" class="block h-8 mt-1 w-full" type="number" />
                        </div>

                        <div>
                            <x-label for="division_gpa" value="{{ __('Division/Gpa') }}" />
                            <x-input wire:model.debounce="division_gpa" id="division_gpa" step="any" class="block h-8 mt-1 w-full" type="text" />
                        </div>

                        <div>
                            <x-label for="board" value="{{ __('Board') }}" />
                            <x-input wire:model.debounce="board" id="board" step="any" class="block h-8 mt-1 w-full" type="text" />
                        </div>

                    </div>

                        
                    <div class="flex items-center justify-end mt-4">
                        @if($is_edit_mode_on)
                            <x-button wire:click.debounce="updateEducation" class="ml-4">
                                {{ __('Save') }}
                            </x-button>

                            <x-button wire:click.debounce="cancelEditMode" class="ml-4">
                                {{ __('Cancel') }}
                            </x-button>
                        @else 
                            <x-button wire:click.debounce="addEducation" class="ml-4">
                                {{ __('Add') }}
                            </x-button>
                        @endif
                    </div>


                </div>
            </div>
        </x-custom-modal>

        <!-- Loader -->
        <x-ui.loading-spinner wire:loading.flex wire:target="confirmDelete, enableEditMode, hideModal, cancelEditMode, updateEducation, cancelEditMode" />
   @endif
</div>