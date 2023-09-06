<section class="bg-white mx-auto max-w-screen-xl rounded-md p-5 font-bangla">
    <h1 class="text-2xl font-bold text-center mb-5">নোটিশ বোর্ড </h1>
    <div class="">
        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative z-20 overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.debounce.350ms="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="খুঁজুন" required="">
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto z-20">
                <table class="w-full whitespace-nowrap text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">তারিখ </th>
                            <th scope="col" class="px-4 py-3">নোটিশ টাইটেল</th>
                            <th scope="col" class="px-4 py-3">
                                বিস্তারিত
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notices ?? [] as $notice)
                            <tr class="border-b text-lg dark:border-gray-700">
                                <td class="px-4 py-3 ">{{ $notice->created_at->format('d M y h:i A') ?? '' }}</td>
                                <td class="px-4 py-3"><a href="{{ route('notice', ['notice_slug' => $notice->slug, 'id' => $notice->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $notice->name ?? '' }}</a></td>
                                <td class="px-4 py-3"><a href="{{ route('notice', ['notice_slug' => $notice->slug, 'id' => $notice->id]) }}" class="font-medium underline text-blue-600 dark:text-blue-500 hover:underline">বিস্তারিত</a></td>
                                </td>
                                <td class="px-4 py-3">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="py-2" aria-label="Table navigation">
                {{ $notices->links() }}
            </nav>
        </div>
    </div>
    <x-ui.loading-spinner wire:loading.flex wire:target="search" />
    <x-ui.loading-spinner wire:loading.flex wire:target="confirmDeleteNotice, enableNoticeEditMode" />
</section>
