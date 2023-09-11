<x-front-layout>
    <section class="container mx-auto mt-5 py-10 md:py-16 px-10 bg-white">
        <div class="flex flex-col items-center gap-3 justify-center mb-10">
            <img class="w-36 h-36 md:w-56 md:h-56 asepct-square block object-cover rounded-full" src="{{ $employee->profileUrl() }}" alt="{{ $employee->name_en }}">
            <h2 class="font-semibold text-sky-900">{{ $employee->bio ?? '' }}</h2>
        </div>
        <div>
        <div class="flow-root">
            <dl class="-my-3 divide-y divide-gray-100 text-sm">
                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Name En</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $employee->name_en ?? '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Name Bn</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->name_bn ?? '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Designation</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->designation ?? '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Subject</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->subject ?? '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Subject Code</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->subject_code ?? '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Mobile No</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->mobile_no ?? '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Email</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->email ?? '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">NID</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->getSafeNid() ?? '' }}</dd>
                </div>


                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Date of Birth</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->date_of_birth ? $employee->date_of_birth->format('d M Y') : '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Join Date</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->join_date ? $employee->join_date->format('d M Y') : '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">This Organization Join Date</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->current_organization_join_date ?  $employee->current_organization_join_date->format('d M Y') : '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Training</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->training ?? '' }}</dd>
                </div>

                <div class=" grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Term</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">{{ $employee->term ?? '' }}</dd>
                </div>

                <div class="grid grid-cols-1 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-bold text-gray-900">Education</dt>
                    <dd class="font-bangal text-gray-700 sm:col-span-2">
                        <div class="overflow-x-auto z-20">
                            <table class="w-full whitespace-nowrap text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Exam Name</th>
                                        <th scope="col" class="px-4 py-3">Passing Year</th>
                                        <th scope="col" class="px-4 py-3">Division/Gpa</th>
                                        <th scope="col" class="px-4 py-3">Board</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee->educations ?? [] as $education)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3">{{ $education->exam_name ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $education->passing_year ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $education->division_gpa ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $education->board ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </dd>
                </div>

            </dl>
            </div> 
        </div>
    </section>
</x-front-layout>
