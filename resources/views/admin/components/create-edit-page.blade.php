<div>
    <div class="rounded-md bg-white p-5 md:p-10">
        <h1 class="font-bold text-xl mb-4">
            @if($is_edit_mode_on)
                Edit Page
            @else
                Add Page
            @endif
        </h1>
        <x-validation-errors class="mb-4" />

        <div class="grid grid-cols-1 gap-4">

            <div class="col-span-2">
                <x-label  for="name" value="{{ __('Name') }}" />
                <x-input wire:model.debounce="name" id="name" class="block mt-1 h-8 w-full" type="text" required />
            </div>

            <div class="col-span-2">
                <x-label for="slug" value="{{ __('Slug') }}" />
                <x-input wire:model.debounce="slug" id="slug" class="block mt-1 h-8 w-full" type="text" required />
            </div>

            <div class="col-span-2">
                <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Excerpt</label>
                <textarea wire:model.debounce="excerpt" id="excerpt" rows="4" class="block p-2.5 w-full text-md text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Excerpt"></textarea>
            </div>

            <div class="block">
                <label for="isPublished" class="flex items-center">
                    <x-checkbox wire:model="is_published" id="isPublished" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Published') }}</span>
                </label>
            </div>

        </div>
    </div>

    <div class="rounded-md bg-white p-5 md:p-10 md:mt-5">
        <h1 class="font-bold text-xl mb-4">Page Content</h1>

        <div>
            <x-label for="lang" value="{{ __('Content Language') }}" />
            <x-ui.select wire:model.debounce="lang" id="lang" class="block h-10 text-md mt-1 w-full">
                <option value="bangla">Bangla</option>
                <option value="english">English</option>
            </x-ui.select>
        </div>


        <div class="mt-5">
            <x-label for="" class="mb-1 block" value="{{ __('Pdf/Image Contents') }}" />
            @if($old_contents)
                <ul class="space-y-2">
                    @foreach($old_contents as  $file)
                        <li class="flex justify-between text-sm text-blue-400">
                            <span>{{ $file->file_name ?? '' }}</span>
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-auto ml-2 px-1.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Old</span>
                            <button wire:click.debounce="removeExistingContentOf({{ $file->id }})" class="text-red-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </li>
                    @endforeach
                </li>
            @endif

            @if($contents)
            <div class="spalce-y-3">
                <div class="mt-3">
                    <ul class="space-y-2">
                        @foreach($contents as $index => $file)
                            <li class="flex justify-between text-sm text-blue-400">
                                <span>{{ $file->getClientOriginalName() }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium ml-2 mr-auto px-1.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">New</span>
                                <button wire:click.debounce="removeContentOf({{ $index }})" class="text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex items-center justify-center mt-2">
                    <button wire:click.debounce="removeAllContents" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md text-xs text-white uppercase tracking-widest ">Remove All</button>
                </div>
            </div>
            @else
            <div class="mt-4">
                <div class="flex items-center justify-center">
                    <label class="w-full flex flex-col items-center px-4 py-4 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-gray-800">
                        <svg class="w-6 h-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-xs leading-normal">Select PDF</span>
                        <input wire:model="contents" multiple type='file' class="hidden" />
                    </label>
                </div>
            </div>
            @endif
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            <div wire:ignore class="col-span-2">
                <x-label  for="content" class="mb-1 block" value="{{ __('Content') }}" />
                <textarea wire:model.debounce="content" id="content" >

                </textarea>
            </div>
        </div>
    </div>

    <div class="rounded-md bg-white p-5 md:p-10 md:mt-5">
        <h1 class="font-bold text-xl mb-4">SEO Details</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="col-span-2">
                <x-label  for="meta_title" value="{{ __('Meta Title') }}" />
                <x-input wire:model.debounce="meta_title" id="meta_title" class="block mt-1 h-8 w-full" type="text"  />
            </div>
            <div class="col-span-2">
                <x-label  for="meta_tags" value="{{ __('Meta Tags') }}" />
                <x-input wire:model.debounce="meta_tags" id="meta_tags" class="block mt-1 h-8 w-full" type="text" />
            </div>
            <div class="col-span-2">
                <x-label  for="meta_description" value="{{ __('Meta Description') }}" />
                <x-ui.textarea wire:model.debounce="meta_description" id="meta_description" class="block mt-1 w-full" type="text" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-8">
            @if($is_edit_mode_on)
                <x-button wire:click.debounce="updatePage" class="ml-4">
                    {{ __('update') }}
                </x-button>
                <x-button wire:click.debounce="cancelEditMode" class="ml-4">
                    {{ __('cancel') }}
                </x-button>
            @else
                <x-button wire:click.debounce="createPage" class="ml-4">
                    {{ __('Create') }}
                </x-button>
            @endif
        </div>

    </div>


    <x-ui.loading-spinner wire:loading.flex wire:target="cancelEditMode, createPage, updatePage" />
</div>


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>

    <script>
        'use strict';

        document.addEventListener('DOMContentLoaded', function() {
            createTinymceInstance('content');
        });

        function createTinymceInstance(selector){
            tinymce.remove('#' + selector)
            tinymce.init({
                selector: '#' + selector,
                min_height: 550,
                default_text_color: 'red',
                plugins: [
                    'advlist', 'autoresize', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'pagebreak',
                    'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                image_advtab: true,
                templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                    },
                    {
                    title: 'Test template 2',
                    content: 'Test 2'
                    }
                ],
                content_css: [],
                setup: function (editor) {

                        editor.on('init change', function () {
                            editor.save();
                        });

                        editor.on('change', function (e) {
                            @this.set(selector, editor.getContent());
                        });

                        window.addEventListener('tinymce:clear', function(e){
                            editor.setContent('');
                        })

                        window.addEventListener('tinymce:set:' + selector, function(e){
                            editor.setContent(e.detail);
                        })
                }

            });
        }


    </script>
@endpush
