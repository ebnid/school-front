<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="p-5 md:p-7 bg-white rounded-md space-y-5">
        <div>
            <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Audience</label>
            <select wire:model.debounce="employee_id" id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Everyone</option>
                @foreach($employees ?? [] as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->user->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input wire:model.debounce="title" type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
        </div>

        <div>
            <label for="message" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Notice Description</label>
            <textarea wire:model.debounce="description" id="message" rows="4" class="block p-2.5 w-full text-md text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
        </div>

        <div class="flex justify-end gap-3">
            @if(!$is_edit_mode_on)
                <x-button wire:click.debounce="createNotice">
                    <span wire:loading.remove wire:target="createNotice, enableEditMode">Create</span>
                    <span wire:loading wire:target="createNotice, enableEditMode">process...</span>
                </x-button>
            @else 
                <x-button wire:click.debounce="updateNotice">
                    <span wire:loading.remove wire:target="updateNotice">Update</span>
                    <span wire:loading wire:target="updateNotice">process...</span>
                </x-button>

                <x-button wire:click.debounce="cancelEditMode">
                    <span wire:loading.remove wire:target="cancelEditMode">Cancel</span>
                    <span wire:loading wire:target="cancelEditMode">process...</span>
                </x-button>
            @endif
        </div>

    </div>
    <div class="p-5 md:p-7 bg-white rounded-md">
        <h1 class="font-bold mb-4">Notices List</h1>

        <ul>
            @forelse($notices ?? [] as $notice)
            <li class="flex gap-5 group">
                <a  class="flex-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $notice->title }}</a>
                <div class="w-14 group-hover:block hidden">
                    <button wire:click.debounce="enableEditMode({{ $notice->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </button>
                    <button wire:click.debounce="deleteHandeler({{ $notice->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
            </li>
            @empty 
                <span class="text-xs">No Notices created</span>
            @endforelse
        </ul>
        <div class="mt-3">
            {{ $notices->links() }}
        </div>
    </div>
</div>
