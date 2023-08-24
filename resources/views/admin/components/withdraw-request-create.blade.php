<div class="bg-white max-w-xl mx-auto p-5 md:p-7">
    <x-errors />
    <div>
        <form wire:submit.prevent="createWithdrawRequest" class="space-y-5">
            <div>
                <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                <input wire:model.debounce="amount" type="number" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            <div>
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                <textarea wire:model.debounce="message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
            </div>
            <x-button  type="submit" >Submit</x-button>
        </form>
    </div>
</div>
