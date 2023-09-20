<div class="bg-white rounded-md max-w-2xl mx-auto px-10 py-12">
    <x-errors />
    <div>
        @if(!$file)
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">XLSX, XLS, CSV</p>
                    </div>
                    <input wire:model.debounce="file" id="dropzone-file" type="file" class="hidden" />
                </label>
            </div>
        @else 
            <div class="flex flex-col items-center">
                <img class="w-1/3 block object-contain" src="{{ asset('assets/images/' . $file->getClientOriginalExtension() . '.png') }}" alt="{{ $file->getClientOriginalName(); }}">
                <h6 class="mt-4 text-lg font-bold dark:text-white">{{ $file->getClientOriginalName(); }}</h6>
            </div>
        @endif
    </div>

    @if($file)
        <div class="mt-5 flex gap-5 justify-center">
            <x-button type="button" wire:click.debounce="startImport">
                <span wire:loading.remove wire:target="startImport">Start Import</span>
                <span wire:loading wire:target="startImport">Processing...</span>
            </x-button>

            <x-button type="button" wire:click.debounce="removeTempFile" >
                <span wire:loading.remove wire:target="removeTempFile">Remove File</span>
                <span wire:loading wire:target="removeTempFile">Removing...</span>
            </x-button>
        </div>
    @endif


    <x-ui.text-loading-spinner wire:loading wire:loading.flex wire:target="file"  loadingText="Uploading file..."/>
</div>
