<x-front-layout>

    @slot('banner')
        @include('front.partials.banner')
    @endslot

    <section class="mt-5">
        <div class="container mx-auto">
            <div class="bg-white md:p-7 font-bangla  py-5 md:py-16">
               <div class="max-w-3xl mx-auto">
                    <h1 class="text-4xl font-extrabold text-center">গভর্নিং বডি</h1>
                    <h1 class="text-3xl mt-7 text-sky-900 font-extrabold text-center">উচাখিলা উচ্চ মাধ্যমিক বিদ্যালয় ও কলেজ</h1>
               </div>

                <div class="space-y-5 mt-5">

                        <embed src="{{ asset('assets/pages/governing-body.pdf') }}" type="application/pdf" width="100%" height="800px">

                        {{-- <img class="block w-full h-auto" src=""> --}}

                </div>


            </div>
        </div>
    </section>
</x-front-layout>
