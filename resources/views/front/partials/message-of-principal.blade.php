@php 

    $principal_profile_url = \App\Models\Setting::where('name', 'principal')->first()->principalPhotoUrl();
    $school_name = \App\Models\Setting::where('name', 'name_en')->first()->value;
    $school_address = \App\Models\Setting::where('name', 'address_en')->first()->value;
    $principal_name = \App\Models\Setting::where('name', 'principal_name')->first()->value;
    $principal_message_1 = \App\Models\Setting::where('name', 'principal_message_excerpt_1')->first()->value;
    $principal_message_2 = \App\Models\Setting::where('name', 'principal_message_excerpt_2')->first()->value;
    $principal_message_page_link = \App\Models\Setting::where('name', 'principal_message_page_link')->first()->value;

    
@endphp

<section class="text-gray-gray-600 body-font">
  <div class="bg-white container px-5 pt-10 md:py-16 mx-auto flex flex-col">
    <div class="lg:w-4/6 mx-auto">
      <div class="rounded-lg md:h-64 overflow-hidden">
        <img alt="content" class="object-contain h-full w-full rounded-md" src="{{ asset('assets/images/message-from-principal.jpg') }}">
      </div>
      <div class="flex flex-col sm:flex-row mt-10">
        <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
          <div class="w-36 h-36 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
            <img src="{{ $principal_profile_url }}" alt="">
          </div>
          <div class="flex flex-col items-center text-center justify-center">
            <h2 class="font-medium title-font mt-4 text-sky-900 text-lg">{{ $principal_name }}</h2>
            <div class="w-12 h-1 bg-sky-900 rounded mt-2 mb-4"></div>
            <p class="text-base text-sky-900">Principal</p>
            <h2 class="font-medium title-font mt-1 text-sky-900 text-sm">{{ $school_name }}</h2>
            <h2 class="font-medium  mt-1 text-sky-900 text-xs">{{ $school_address }}</h2>

          </div>
        </div>
        <div class="text-sky-900 sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
            <p class="leading-relaxed text-lg mb-4">{{ $principal_message_1 }}</p>
            <p class="leading-relaxed text-lg mb-4">{{ $principal_message_2 }}</p>
            <a href="{{ $principal_message_page_link }}" class="hover:scale-105 inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-sky-900 focus:ring-4 focus:ring-blue-300">
                More
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            <!-- <p class="leading-relaxed text-lg mb-4">The main purpose of this institute to explore creativity and hidden talent the student with co-curricular activities has been created. Under the strong administrative and in exchange of endless industry of teachers, systematical education management has been ensured here. As a result, the students board exam at every stages have been toped with GPA 5 more than expectation and 15/16 scholarships this upazila.</p> -->
            <!-- <p class="leading-relaxed text-lg mb-4">The students have been achieving great success in all types of co-curricular activities & sports. Confidently I believed that this institutions will go forward coming days with fame and spreading a lot of reputation, after all this institutions will be succeed in all sectors.</p> -->
        </div>
      </div>
    </div>
  </div>
</section>