<x-front-layout>

    @slot('banner')
        @include('front.partials.banner')
    @endslot
    
    <div class="container mx-auto rounded-md bg-white md:p-7 mt-5">
    <h1 class="font-bangla text-center mb-4 text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">গাল্যারী</span></h1>
        @include('front.partials.photo-gallery')
    </div>
</x-front-layout>
