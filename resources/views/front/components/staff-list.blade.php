<div class="p-5 md:p-10 bg-gray-100 rounded-md">
    <h1 class="font-bangla font-bold mb-10 text-3xl text-center text-sky-900">মোট স্টাফ তালিকা</h1>

    <div class="mb-5 flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2 mx-auto">
            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.debounce.350ms="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-900 focus:border-sky-900 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="খুঁজুন" required="">
                </div>
            </form>
        </div>
    </div>

    <section class="dark:bg-gray-900">
        <div class="container md:px-6 mx-auto">
            <div class="grid gap-5 md:gap-8 mt-8 grid-cols-1 lg:grid-cols-4">
                @foreach($staffs as $staff)
                    <div class="w-full max-w-xs text-center bg-white pt-5 pb-4 px-5">
                        <img class="aspect-square object-cover object-center w-full mx-auto rounded-lg" src="{{ $staff->profileUrl() }}" alt="avatar" />

                        <div class="mt-2">
                            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-200">{{ $staff->name_en }}</h3>
                            <span class="mt-1 font-medium text-gray-600 dark:text-gray-300">{{ $staff->designation }}</span>
                            <a href="{{ route('employee-details', ['id' => $staff->id ]) }}" class="hover:underline mt-2 block text-blue-400">Profile</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="mt-10">
        {{ $staffs->links() }}
    </div>
    
</div>
