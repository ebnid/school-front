<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">Add Teacher/Staff</h1>

    <x-errors class="mb-4" />

    <div class="grid grid-cols-1 gap-5">

        <div>
            <x-label for="" class="mb-1 block" value="{{ __('Pofile') }}" />
            @if(!$image && $old_image)
                <div class="flex items-center justify-center mb-3">
                    <img class="rounded-md w-36 h-36 aspect-square object-contain block" src="{{ $old_image ?? '' }}">
                </div>
            @endif

            @if($image)
                <div class="">
                    <div class="flex items-center justify-center">
                        @if ($image)
                            <img class="w-36 h-36 aspect-square rounded-md object-contain block" src="{{ $image->temporaryUrl() }}">
                        @endif
                    </div>
                    <div class="flex items-center justify-center mt-2">
                        <button wire:click.debounce="removeTempProfile" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
                    </div>
                </div>
            @else
            <div>
                <div class="flex items-center justify-center">
                    <label class="w-full flex flex-col items-center px-4 py-4 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-xs leading-normal">Select a Image</span>
                        <input wire:model="image" type='file' class="hidden" />
                    </label>
                </div>
            </div>
            @endif
        </div>

        <div>
            <x-label for="name_en" value="{{ __('Name En') }}" />
            <x-input wire:model.debounce="name_en" id="name_en" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="name_bn" value="{{ __('Name Bn') }}" />
            <x-input wire:model.debounce="name_bn" id="name_bn" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="mobile_no" value="{{ __('Mobile No') }}" />
            <x-input wire:model.debounce="mobile_no" id="mobile_no" class="block h-8 mt-1 w-full" type="number" />
        </div>

        <div>
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input wire:model.debounce="email" id="email" class="block h-8 mt-1 w-full" type="email" />
        </div>

        <div>
            <x-label for="nid_no" value="{{ __('NID') }}" />
            <x-input wire:model.debounce="nid_no" id="nid_no" class="block h-8 mt-1 w-full" type="number" />
        </div>

        <div>
            <label for="present_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Present Address</label>
            <textarea wire:model.debounce="present_address" id="present_address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
        </div>

        <div>
            <label for="permanent_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permanent Address</label>
            <textarea wire:model.debounce="permanent_address" id="permanent_address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
        </div>


        <div>
            <x-label for="designation" value="{{ __('Designation') }}" />
            <x-input wire:model.debounce="designation" id="designation" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="date_of_birth" value="{{ __('Date of Birth') }}" />
            <x-input wire:model.debounce="date_of_birth" id="date_of_birth" class="block h-8 mt-1 w-full" type="date" />
        </div>

        <div>
            <x-label for="join_date" value="{{ __('Join Date') }}" />
            <x-input wire:model.debounce="join_date" id="join_date" class="block h-8 mt-1 w-full" type="date" />
        </div>

        
        <div>
            <x-label for="current_organization_join_date" value="{{ __('Current Org Join Date') }}" />
            <x-input wire:model.debounce="current_organization_join_date" id="current_organization_join_date" class="block h-8 mt-1 w-full" type="date" />
        </div>


        <div>
            <x-label for="subject" value="{{ __('Subject') }}" />
            <x-input wire:model.debounce="subject" id="subject" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="subject_code" value="{{ __('Subject Code') }}" />
            <x-input wire:model.debounce="subject_code" id="subject_code" class="block h-8 mt-1 w-full" type="number" />
        </div>

        <div>
            <x-label for="examinner_code" value="{{ __('Examinner Code') }}" />
            <x-input wire:model.debounce="examinner_code" id="examinner_code" class="block h-8 mt-1 w-full" type="number" />
        </div>

        <div>
            <x-label for="training" value="{{ __('Training') }}" />
            <x-input wire:model.debounce="training" id="training" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="term" value="{{ __('Terms') }}" />
            <x-input wire:model.debounce="term" id="term" class="block h-8 mt-1 w-full" type="text" />
        </div>


        <div>
            <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bio</label>
            <textarea wire:model.debounce="bio" id="bio" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
        </div>

        <div>
            <x-label for="employee_type" value="{{ __('Employee Type') }}" />
            <x-ui.select wire:model.debounce="employee_type" id="employee_type" class="block h-10 text-md mt-1 w-full">
                <option value="">Select</option>
                <option value="teacher">Teacher</option>
                <option value="staff">Staff</option>
            </x-ui.select>
        </div>


        <div class="block">
            <label for="is_published" class="flex items-center">
                <x-checkbox wire:model.debounce="is_published" id="is_published" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click.debounce="createEmployee" class="ml-4">
                {{ __('Add') }}
            </x-button>
        </div>

    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="removeTempProfile, image, createEmployee" />
</div>
