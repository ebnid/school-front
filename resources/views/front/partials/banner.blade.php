@php 

    $name_lang = \App\Models\Setting::where('name', 'name_lang')->first()->value;

    $school_name = null;
    $school_address = null;

    if($name_lang === 'bangla'){
        $school_name = \App\Models\Setting::where('name', 'name_bn')->first()->value;
        $school_address = \App\Models\Setting::where('name', 'address_bn')->first()->value;
    }
    
    if($name_lang === 'english'){
        $school_name = \App\Models\Setting::where('name', 'name_en')->first()->value;
        $school_address = \App\Models\Setting::where('name', 'address_en')->first()->value;
    }
   
@endphp


<section class="md:mt-3 {{ $name_lang === 'bangla' ? 'font-bangla' : '' }}">
    <div class="relative container mx-auto h-48" style="background-image: url('https://www.bssnews.net/assets/news_photos/2023/07/28/image-138809-1690531929.jpg')">
        <div class="absolute w-full h-full inset-0 bg-gradient-to-r bg-gradient-to-r from-sky-400 via-emerald-600 to-transparent">
            <div class="flex p-5 md:p-10">
                <div class="">
                    <!-- <h1 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">উচাখিলা উচ্চ বিদ্যালয় ও কলেজে</span></h1> -->
                    <h1 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-white">{{ $school_name }}</span></h1>
                    <!-- <h1 class="mb-3 text-lg font-extrabold text-gray-900 dark:text-white"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">ইশ্বরগঞ্জ, ময়মনসিংহ।</span></h1> -->
                    <h1 class="mb-3 text-lg font-extrabold"><span class="text-white">{{ $school_address }}</span></h1>
                    <div class="max-w-2xl">
                        @include('front.partials.announcebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>