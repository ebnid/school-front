<div class="bg-white p-5 rounded-md">
    <h1 class="font-bold text-xl mb-4">Add Announce</h1>

    <x-validation-errors class="mb-4" />

    <div class="grid grid-cols-1 gap-5">

        <div>
            <label for="announce" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Announce</label>
            <textarea wire:model.debounce="announce" id="announce" rows="4" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
        </div>

        <div>
            <x-label for="link" value="{{ __('Link') }}" />
            <x-input wire:model.debounce="link" id="link" class="block h-8 mt-1 w-full" type="text" />
        </div>

        <div>
            <x-label for="order" value="{{ __('Order') }}" />
            <x-input wire:model.debounce="order" id="order" class="block h-8 mt-1 w-full" type="number" />
        </div>


        <div class="block">
            <label for="is_published" class="flex items-center">
                <x-checkbox wire:model.debounce="is_published" id="is_published" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click.debounce="createAnnouncement" class="ml-4">
                {{ __('Create') }}
            </x-button>
        </div>

    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="createAnnouncement" />
</div>
