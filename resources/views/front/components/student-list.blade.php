<section class="bg-white mx-auto max-w-screen-xl rounded-md p-5 font-bangla">
    <h1 class="text-2xl font-bold text-sky-900 text-center mb-5">ছাত্র/ছাত্রী তালিকা</h1>
    <div class="">

        <!-- Filter option -->
        <div class="grid gap-5 grid-cols-1 md:grid-cols-3 ">
            <div>
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                <select wire:model.debounce="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose a year</option>
                    @foreach($years ?? [] as $year)
                        <option value="{{ $year }}">{{ $year ?? '' }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="ymonthear" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Month</label>
                <select  id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose a month</option>
                </select>
            </div>


            <div>
                <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee</label>
                <select  id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose a employee</option>
                </select>
            </div>

        </div>

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
                            <th scope="col" class="px-4 py-3">ছবি</th>
                            <th scope="col" class="px-4 py-3">নাম</th>
                            <th scope="col" class="px-4 py-3">শ্রেণি</th>
                            <th scope="col" class="px-4 py-3">সেশন</th>
                            <th scope="col" class="px-4 py-3">
                                বিস্তারিত
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students ?? [] as $student)
                            <tr class="border-b text-lg dark:border-gray-700">
                                <td class="px-4 py-3 ">

                                </td>
                                <td class="px-4 py-3">{{ $student->sname ?? '' }}</td>
                                <td class="px-4 py-3">{{ $student->cyear }}</td>
                                <td class="px-4 py-3">{{ $student->session }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="py-2" aria-label="Table navigation">
                {{ $students->links() }}
            </nav>
        </div>
    </div>
    <x-ui.loading-spinner wire:loading.flex wire:target="search" />
</section>
