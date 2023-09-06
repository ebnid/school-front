<x-front-layout>
    <div class="{{ $page->lang === 'bangla' ? 'font-bangla' : '' }} container mx-auto rounded-md md:p-10 bg-white mt-5">
        <div class="max-w-3xl mx-auto py-5 md:py-16">
            <h1 class="text-center mb-6 text-2xl md:text-4xl text-transparent font-extrabold md:text-3xl bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 leading-none tracking-tight">{{ $page->name }} <span class="text-blue-600 dark:text-blue-500"></span></h1>

            <div class="space-y-5 text-justify">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</x-front-layout>
