<div class="bg-white px-7 py-16 rounded-sm">
    <div class="flow-root">
        <dl class="-my-3 divide-y divide-gray-100 text-sm">

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">School/College Name Bengali</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="name_bn" class="block mt-1 w-full" type="text" />
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">School/College Name English</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="name_en" class="block mt-1 w-full" type="text" />
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">School/College Address Bengali</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="address_bn" class="block mt-1 w-full" type="text" />
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">School/College Address English</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="address_en" class="block mt-1 w-full" type="text" />
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Click Admission Button Text</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="admission_button_text" class="block mt-1 w-full" type="text" />
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Click Admission Button Link</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="admission_button_link" class="block mt-1 w-full" type="text" />
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Principal Message Exceprt 1</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div class="col-span-2">
                        <textarea wire:model.debounce="principal_message_excerpt_1" id="excerpt" rows="4" class="block p-2.5 w-full text-md text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Excerpt"></textarea>
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Principal Message Exceprt 2</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div class="col-span-2">
                        <textarea wire:model.debounce="principal_message_excerpt_2" id="excerpt" rows="4" class="block p-2.5 w-full text-md text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Excerpt"></textarea>
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Email</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="email" class="block mt-1 w-full" type="email" />
                    </div>
                </dd>
            </div>

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Mobile No</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="mobile" class="block mt-1 w-full" type="number" />
                    </div>
                </dd>
            </div>

        </dl>
    </div>
    <div class="mt-10 flex justify-end">
        <x-button wire:click.debounce="saveChanges">Save</x-button>
    </div>
</div>
