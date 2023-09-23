<div class="bg-white px-7 py-16 rounded-sm">
    <div class="flow-root">
        <dl class="-my-3 divide-y divide-gray-100 text-sm">

            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Showing Language</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-ui.select wire:model.debounce="name_lang" class="block h-10 text-md mt-1 w-full">
                            <option value="bangla">Bangla</option>
                            <option value="english">English</option>
                        </x-ui.select>
                    </div>
                </dd>
            </div>

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
                <dt class="font-base  text-gray-900">Principal Name</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="principal_name" class="block mt-1 w-full" type="text" />
                    </div>
                </dd>
            </div>


            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Principal Message Page Link</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        <x-input wire:model.debounce="principal_message_page_link" class="block mt-1 w-full" type="text" />
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
                        <x-input wire:model.debounce="mobile" class="block mt-1 w-full" type="text" />
                    </div>
                </dd>
            </div>

            
            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Principal Signature</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        @if(!$principal_signature && $old_principal_signature)
                            <div class="flex items-center justify-center mb-3">
                                <img class="rounded-md w-36 h-36 aspect-square object-contain block" src="{{ $old_principal_signature ?? '' }}">
                            </div>
                        @endif

                        @if($principal_signature)
                            <div class="">
                                <div class="flex items-center justify-center">
                                    @if($principal_signature)
                                        <img class="w-36 h-36 aspect-square rounded-md object-contain block" src="{{ $principal_signature->temporaryUrl() }}">
                                    @endif
                                </div>
                                <div class="flex items-center justify-center mt-2">
                                    <button wire:click.debounce="removeTempPrincipalSignature" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
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
                                    <input wire:model="principal_signature" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </dd>
            </div>


            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Logo</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        @if(!$logo && $old_logo)
                            <div class="flex items-center justify-center mb-3">
                                <img class="rounded-md w-36 h-36 aspect-square object-contain block" src="{{ $old_logo ?? '' }}">
                            </div>
                        @endif

                        @if($logo)
                            <div class="">
                                <div class="flex items-center justify-center">
                                    @if($logo)
                                        <img class="w-36 h-36 aspect-square rounded-md object-contain block" src="{{ $logo->temporaryUrl() }}">
                                    @endif
                                </div>
                                <div class="flex items-center justify-center mt-2">
                                    <button wire:click.debounce="removeTempLogo" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
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
                                    <input wire:model="logo" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </dd>
            </div>


            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Banner</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        @if(!$banner && $old_banner)
                            <div class="flex items-center justify-center mb-3">
                                <img class="rounded-md w-full aspect-video object-contain block" src="{{ $old_banner ?? '' }}">
                            </div>
                        @endif

                        @if($banner)
                            <div class="">
                                <div class="flex items-center justify-center">
                                    @if($banner)
                                        <img class="w-full rounded-md object-contain block" src="{{ $banner->temporaryUrl() }}">
                                    @endif
                                </div>
                                <div class="flex items-center justify-center mt-2">
                                    <button wire:click.debounce="removeTempBanner" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
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
                                    <input wire:model="banner" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </dd>
            </div>


            <div class="text-lg grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                <dt class="font-base  text-gray-900">Principa's Photo</dt>
                <dd class="text-gray-700 sm:col-span-2">
                    <div>
                        @if(!$principal_photo && $old_principal_photo)
                            <div class="flex items-center justify-center mb-3">
                                <img class="rounded-md w-36 h-36 aspect-square object-contain block" src="{{ $old_principal_photo ?? '' }}">
                            </div>
                        @endif

                        @if($principal_photo)
                            <div class="">
                                <div class="flex items-center justify-center">
                                    @if ($principal_photo)
                                        <img class="w-36 h-36 aspect-square rounded-md object-contain block" src="{{ $principal_photo->temporaryUrl() }}">
                                    @endif
                                </div>
                                <div class="flex items-center justify-center mt-2">
                                    <button wire:click.debounce="removeTempPrincipalPhoto" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ">Remove</button>
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
                                    <input wire:model="principal_photo" type='file' class="hidden" />
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </dd>
            </div>

        </dl>
    </div>
    <div class="mt-10 flex justify-end">
        <x-button wire:click.debounce="saveChanges">Save</x-button>
    </div>

    <x-ui.loading-spinner wire:loading.flex wire:target="saveChanges, logo, banner, principal_photo, removeTempLogo, removeTempBanner, removeTempPrincipalPhoto" />
</div>
