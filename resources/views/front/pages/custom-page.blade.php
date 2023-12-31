<x-front-layout>

    @slot('banner')
        @include('front.partials.banner')
    @endslot
    
    <div class="{{ $page->lang === 'bangla' ? 'font-bangla' : '' }} container mx-auto rounded-md md:p-10 bg-white mt-5">
        <div class="max-w-3xl mx-auto py-5 md:py-16">
            <h1 class="text-sky-900 text-center mb-6 text-2xl md:text-4xl font-extrabold md:text-3xl leading-none tracking-tight">{{ $page->name }} <span class="text-blue-600 dark:text-blue-500"></span></h1>

            <div class="space-y-5 text-justify">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</x-front-layout>
