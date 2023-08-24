<div>
   @if($is_response_mode_on)
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
                    <form wire:submit.prevent="sendResponse" class="space-y-5">
                        
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <p class="mb-3 text-gray-500 dark:text-gray-400">{{ $leave->title ?? '' }}</p>
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Reason</label>
                            <p class="mb-3 text-gray-500 dark:text-gray-400">{{ $leave->reason ?? '' }}</p>
                        </div>

                        <div>
                            <label for="from_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">From Date</label>
                            <input wire:model.debounce="from_date" type="date" id="from_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>

                        <div>
                            <label for="to_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">To Date</label>
                            <input wire:model.debounce="to_date" type="date" id="to_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        
                        <div>
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Response Message</label>
                            <textarea wire:model.debounce="leave.management_response" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                        </div>

                        @canany(['admin', 'root'])

                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leaves Types</label>
                            <select wire:model.debounce="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a type</option>
                                <option value="{{ \App\Models\Attendance::ATTENDANCE_OFF_DAY }}">Off Day</option>
                                <option value="{{ \App\Models\Attendance::ATTENDANCE_PRESENT }}">Present</option>
                                <option value="{{ \App\Models\Attendance::ATTENDANCE_ABSENT }}">Absent</option>
                                <option value="{{ \App\Models\Attendance::ATTENDANCE_REPLACE }}">Replace</option>
                                <option value="{{ \App\Models\Attendance::ATTENDANCE_PAY_LEAVE }}">Payable Leave</option>
                                <option value="{{ \App\Models\Attendance::ATTENDANCE_NO_PAY_LEAVE }}">Non Payable Leave</option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leave Status</label>
                            <select wire:model.debounce="leave.status" id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a  type</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        
                        <x-button  type="submit" >Send</x-button>

                        @endcanany

                    </form>
                </div>

            </div>
        </x-custom-modal>

        <!-- Loader -->
        <x-loader wire:loading wire:target="cancelEditMode, sendResponse" />
   @endif
</div>