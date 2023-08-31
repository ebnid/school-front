<div class="bg-white p-5 rounded-md pb-10">
    
    <h1 class="mb-4 text-4xl text-center font-extrabold text-gray-900 dark:text-white"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Overtime</span></h1>
    <p class="text-center text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">{{ now()->format('d M Y h:i A') }}</p>
    
    @if($last_overtime && $last_overtime->start_at && !$last_overtime->end_at)
        <h1 class="mb-4 text-6xl mt-5 text-center font-extrabold text-gray-900 dark:text-white"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">{{ $current_overtime }}</span><span class="text-2xl ml-1 text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Minutes from {{ $last_overtime->start_at->format('h:i: A') }}</span></h1>
    @endif

    <div class="flex justify-center mt-8">
        @if(!$last_overtime || !$is_unfinished_overtime)
            <x-button wire:click.debounce="startOvertime" type="button">
                <span wire:loading.remove wire:target="startOvertime">Start</span>
                <span wire:loading wire:target="startOvertime">Processing...</span>
            </x-button>
        @elseif($last_overtime && $last_overtime->start_at && !$last_overtime->end_at)
            <x-button wire:click.debounce="endOvertime" type="button">
                <span wire:loading.remove wire:target="endOvertime">Stop</span>
                <span wire:loading wire:target="endOvertime">Processing...</span>
            </x-button>
            <x-button wire:click.debounce="refreshOvertime" type="button" class="ml-2">
                <span wire:loading.remove wire:target="refreshOvertime">Refresh</span>
                <span wire:loading wire:target="refreshOvertime">Fetching...</span>
            </x-button>
        @endif
    </div>
</div>

