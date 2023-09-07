<section class="bg-white mx-auto max-w-screen-xl rounded-md p-5 font-bangla py-5 md:py-16">
    <h1 class="text-2xl font-bold text-sky-900 text-center mb-5">ছাত্র/ছাত্রী তালিকা</h1>
    <div class="">

        <!-- Filter option -->
        <div class="grid gap-5 grid-cols-1 md:grid-cols-3 ">
            <div>
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">সেশন</label>
                <select wire:model.debounce="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Choose a year</option>
                    @foreach($years ?? [] as $year)
                        <option value="{{ $year }}">{{ $year ?? '' }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="ymonthear" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">শ্রেণি</label>
                <select  id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">সকল</option>
                    <option value="six">ষষ্ঠ</option>
                    <option value="seven">সপ্তম</option>
                    <option value="eight">অষ্টম</option>
                    <option value="nine">নবম</option>
                    <option value="nine(voc)">নবম</option>
                    <option value="ten">দশম</option>
                    <option value="ten(voc)">দশম (ভোকেশনাল)</option>
                    <option value="first">একাদ্বশ</option>
                    <option value="second">দ্বাদশ</option>
                </select>
            </div>


            <div>
                <label for="student_gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ছাত্র/ছাত্রী</label>
                <select  id="student_gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">উভয়</option>
                    <option value="male">ছাত্র</option>
                    <option value="female">ছাত্রী</option>
                </select>
            </div>

        </div>

        <!-- Start coding here -->
        <div class="bg-white dark:bg-gray-800 relative z-20 overflow-hidden">
            <div class="overflow-x-auto z-20">
                <table class="w-full whitespace-nowrap text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">ছবি</th>
                            <th scope="col" class="px-4 py-3">নাম</th>
                            <th scope="col" class="px-4 py-3">লিঙ্গ</th>
                            <th scope="col" class="px-4 py-3">শ্রেণি</th>
                            <th scope="col" class="px-4 py-3">সেশন</th>
                            <th scope="col" class="px-4 py-3">বিভাগ</th>
                            <th scope="col" class="px-4 py-3">শাখা</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students ?? [] as $student)
                            <tr class="border-b text-lg dark:border-gray-700">
                                <td class="px-4 py-3 ">
                                    @if($student->sex === 'MALE')
                                        @if($student->cyear === 'FIRST' || $student->cyear === 'SECOND')
                                            <img src="https://uchakhilahss.edu.bd/college_sas/automation/{{ $student->location }}" class="block w-20 h-20 rounded-full">
                                        @else 
                                            <img src="https://uchakhilahss.edu.bd/school_sas/automation/{{ $student->location }}" class="block w-20 h-20 rounded-full">
                                        @endif
                                    @else 
                                        @if($student->cyear === 'FIRST' || $student->cyear === 'SECOND')
                                            <img src="https://uchakhilahss.edu.bd/college_sas/automation/{{ $student->location }}" class="blur-sm block w-20 h-20 rounded-full">
                                        @else 
                                            <img src="https://uchakhilahss.edu.bd/school_sas/automation/{{ $student->location }}" class="blur-sm block w-20 h-20 rounded-full">
                                        @endif
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $student->sname ?? '' }}</td>
                                <td class="px-4 py-3">{{ $student->sex ?? '' }}</td>
                                <td class="px-4 py-3">{{ $student->cyear }}</td>
                                <td class="px-4 py-3">{{ $student->session }}</td>
                                <td class="px-4 py-3">{{ $student->grup }}</td>
                                <td class="px-4 py-3">{{ $student->religion }}</td>
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
