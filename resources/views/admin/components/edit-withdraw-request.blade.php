<div>
   @if($is_edit_mode_on)
        <x-custom-modal>
            <div class="bg-white max-w-xl mx-auto rounded-md mt-10">
                <!-- Header -->
                <div class="p-5 flex justify-between border-b">
                    <h1>Edit</h1>
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
                    <form wire:submit.prevent="updateWithdrawRequest" class="space-y-5">

                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input wire:model.debounce="withdraw.amount" type="number" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        
                        <div>
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                            <textarea wire:model.debounce="withdraw.message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                        </div>

                        @canany(['admin', 'root'])
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select wire:model.debounce="withdraw.status" id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a  status</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        @endcanany

                        <x-button  type="submit" >Update</x-button>

                    </form>
                </div>

            </div>
        </x-custom-modal>

        <!-- Loader -->
        <x-loader wire:loading wire:target="cancelEditMode, updateWithdrawRequest" />
   @endif
</div>