<div class="bg-white p-5 rounded-md relative">
    <h1 class="text-center font-bold text-xl mb-5">Notice Board</h1>

    <!-- Notice Board -->
    <div class="font-bangla">
        <h1 class="mb-4 text-center text-2xl font-extrabold leading-none tracking-tight text-gray-900 text-blue-600 dark:text-white">{{ $notice->title ?? '' }}</h1>
        <p class="mb-3 text-gray-500 dark:text-gray-400">{{ $notice->description ?? '' }}</p>
        <span class="mb-5 block text-xs" >
            @if($notice)
                {{ $notice->created_at->format('d M Y h:i A') }}
            @endif
        </span>
    </div>

    <!-- Notice List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 font-bangla">
        <!-- All -->
        <div>
            <h2 class="font-bold text-sm">For Everyone</h2>
            <ul>
                @foreach($everyone_notices as $notice)
                    <li><a wire:click.debounce="activeNotice({{ $notice->id }})"  class="cursor-pointer font-medium text-sm text-blue-600 dark:text-blue-500 hover:underline">{{ $notice->title }}</a></li>
                @endforeach
            </ul>
        </div>

        <!-- Only For You -->
        <div>
            <h2 class="font-bold text-sm">For You</h2>
            <ul>
                @foreach($my_notices as $notice)
                    <li><a wire:click.debounce="activeNotice({{ $notice->id }})" class="cursor-pointer font-medium text-sm text-blue-600 dark:text-blue-500 hover:underline">{{ $notice->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div wire:loading wire:target="activeNotice" class="absolute inset-0 w-full h-full bg-black opacity-50 rounded-md">
        <div class="flex items-center justify-center w-full h-full"><span class="text-white">Loading...</span></div>
    </div>
</div>
