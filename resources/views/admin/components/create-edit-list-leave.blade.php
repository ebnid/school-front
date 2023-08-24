<div class="flex flex-col md:flex-row bg-white gap-5 p-5 md:p-7">

    <div class="w-full md:w-2/6 md:border md:p-5 rounded-md">
        <x-errors />
        <div class="space-y-5">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input wire:model.debounce="title" type="text" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>

            <div>
                <label for="leave_start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">From</label>
                <input wire:model.debounce="from_date" type="date" id="leave_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>

            <div>
                <label for="leave_end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">To</label>
                <input wire:model.debounce="to_date" type="date" id="leave_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>

            <div>
                <label for="reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reason</label>
                <textarea wire:model.debounce="reason" id="reason" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
            </div>

            <div class="flex justify-end">

                @if($is_edit_mode_on)
                    <x-button wire:click.debonce="updateLeaveRequest">
                        <span wire:loading.remove wire:target="updateLeaveRequest">Update</span>
                        <span wire:loading wire:target="updateLeaveRequest">Updating...</span>
                    </x-button>
                @else 
                    <x-button wire:click.debonce="applyLeaveRequest">
                        <span wire:loading.remove wire:target="applyLeaveRequest">Apply</span>
                        <span wire:loading wire:target="applyLeaveRequest">Proccesing...</span>
                    </x-button>
                @endif

            </div>
        </div>
    </div>

    <div class="w-full md:w-4/6 bg-white relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        From
                    </th>
                    <th scope="col" class="px-6 py-3">
                        To
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves ?? [] as $leave)
                    <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $leave->created_at->format('d M Y h:i A') ?? '' }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $leave->title ?? '' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $leave->from_date->format('d M Y') }} 
                        </td>
                        <td class="px-6 py-4">
                            {{ $leave->to_date->format('d M Y') }} 
                        </td>
                        <td class="px-6 py-4">
                            @if($leave->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                            @elseif($leave->status === 'accepted')
                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Accepted</span>
                            @elseif($leave->status === 'canceled')
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Canceled</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($leave->status === 'pending')
                                <div class="group-hover:block hidden">
                                    <button wire:click.debounce="editHandeler({{ $leave->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>

                                    <button wire:click.debounce="deleteHandeler({{ $leave->id }})" >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            @else 
                                <button wire:click.debounce="leaveRequestResponseDetail({{ $leave->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Response</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5">
            {{ $leaves->links() }}
        </div>
    </div>

</div>

@stack('modals')
    <livewire:leave-response-detail />
@endstack