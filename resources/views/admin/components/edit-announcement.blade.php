<div>
    @if($is_edit_mode_on)
    <x-ui.edit-modal class="max-w-2xl">
        <div class="p-5 md:pl-10 md:pb-10 md:pr-10 bg-white rounded-md">

            <div class="flex justify-end mb-2">
                <span wire:click.debounce="cancelEditMode" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>

            <x-validation-errors class="mb-4" />

            <div class="grid grid-cols-1 gap-5">


                <div>
                    <label for="announce" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Announce</label>
                    <textarea wire:model.debounce="announcement.announce" id="announce" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>

                <div>
                    <x-label for="link" value="{{ __('Link') }}" />
                    <x-input wire:model.debounce="announcement.link" id="link" class="block h-8 mt-1 w-full" type="text" />
                </div>

                <div>
                    <x-label for="order" value="{{ __('Order') }}" />
                    <x-input wire:model.debounce="announcement.order" id="order" class="block h-8 mt-1 w-full" type="number" />
                </div>

                <div class="block">
                    <label for="is_published" class="flex items-center">
                        <x-checkbox wire:model.debounce="announcement.is_published" id="is_published" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end">
                    <x-button wire:click.debounce="updateAnnouncement" type="button" class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                    <x-button wire:click.debounce="cancelEditMode" type="button" class="ml-4">
                        {{ __('Cancel') }}
                    </x-button>
                </div>

            </div>

            <x-ui.loading-spinner wire:loading.flex wire:target="updateAnnouncement, cancelEditMode" />
        </div>
    </x-ui.edit-modal>
    @endif
</div>