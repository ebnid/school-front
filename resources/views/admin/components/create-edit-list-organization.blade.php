<div class="bg-white p-7 max-w-2xl">

    <!-- Validation errors -->
    <x-errors />

    <!-- Form -->
    <div>
        <div class="mb-5">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input wire:model.debounce="name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
        </div>       

        @if($organization_id)
            <x-button wire:click.debounce="updateOrgHandeler" type="button" >Update</x-button>
        @else 
            <x-button wire:click.debounce="createOrgHandeler" type="button" >Add</x-button>
        @endif
    </div>

    <!-- List -->
    <div class="mt-8">
        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($organizations as $organization)
                <li class="group py-1 md:py-2">
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-md md:text-xl font-medium text-gray-900 truncate dark:text-white">
                                {{ $organization->name ?? '' }}
                            </p>
                        </div>
                        <div class="group-hover:block hidden">
                            <button wire:click.debounce="editHandeler({{ $organization->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>

                            <button wire:click.debounce="deleteHandeler({{ $organization->id }})" >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</div>

