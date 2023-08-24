<div>
   @if($is_leave_response_detail_show)
        <x-custom-modal>
            <div class="bg-white max-w-xl mx-auto rounded-md mt-10 pb-5">
                <!-- Header -->
                <div class="p-5 flex justify-between border-b">
                    <h1>{{ $leave->employee->user->name ?? '' }}</h1>
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
                    <div class="space-y-5">
                        
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <p class="mb-3 border-b text-gray-900 italic dark:text-gray-400">{{ $leave->title ?? '' }}</p>
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Reason</label>
                            <p class="border rounded-md p-2 mb-3 text-gray-500 dark:text-gray-400">{{ $leave->reason ?? '' }}</p>
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Management Response</label>
                            <p class="border rounded-md p-2 mb-3 text-gray-500 dark:text-gray-400">{{ $leave->management_response ?? '' }}</p>
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Leave Duration</label>
                            <p class="border rounded-md p-2 mb-3 text-gray-500 dark:text-gray-400">{{ $leave->from_date->format('d M Y') ?? '' }} to {{ $leave->to_date->format('d M Y') ?? '' }}</p>
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Leave Status</label>
                            @if($leave->status === 'accepted')
                                <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Accepted</span>
                            @elseif($leave->status === 'canceled')
                                <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Canceled</span>
                            @else 
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                            @endif
                        </div>


                    </div>
                </div>

            </div>
        </x-custom-modal>

        <!-- Loader -->
        <x-loader wire:loading wire:target="cancelEditMode, sendResponse" />
   @endif
</div>