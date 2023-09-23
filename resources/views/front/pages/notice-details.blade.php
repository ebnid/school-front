<x-front-layout>

    @slot('banner')
        @include('front.partials.banner')
    @endslot
    
    <section class="mt-5">
        <div class="container mx-auto">
            <div class="bg-white md:p-7 font-bangla  py-5 md:py-16">
               <div class="max-w-3xl mx-auto">
                    <h1 class="text-4xl font-extrabold text-center">নোটিশ</h1>
                    <h1 class="text-3xl mt-7 text-sky-900 font-extrabold text-center">{{ $notice->name ?? '' }}</h1>
                    <p class="mt-5">{{ $notice->created_at->format('d M Y h:i A') }}</p>
                    <p class="text-lg mt-7">{!! $notice->content ?? '' !!}</p>
               </div>
               <div class="space-y-5 mt-5">
                    @foreach($notice->contentsUrl() as $file)
                        @if($file['extension'] === 'pdf')
                            <embed src="{{ $file['url'] }}" type="application/pdf" width="100%" height="800px">
                        @else 
                            <img class="block w-full h-auto" src="{{ $file['url'] }}">
                        @endif
                    @endforeach
                </div>

                @if($notice->is_include_principal_signature)

                    @php 
                        $prinicpal_signature = \App\Models\Setting::where('name', 'principal_signature')->first()->principalSignatureUrl();
                    @endphp

                    <div class="max-w-3xl mx-auto">
                        <div class="mt-20 w-1/3 flex flex-col items-center">
                            <img class="w-1/2 block" src="{{ $prinicpal_signature }}">
                            <h2 class="text-lg font-bold mt-5">মোহাম্মদ আবদুল হালিম</h2>  
                            <p class="text-md">অধ্যক্ষ</p>
                            <p class="text-base">উচাখিলা উচ্চ মাধ্যমিক বিদ্যালয় ও কলেজ</p>
                            <p class="text-base">ঈশ্বরগঞ্জ, ময়মনসিংহ</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="mt-5">
        @include('front.partials.pages-collection')
    </section>
</x-front-layout>
