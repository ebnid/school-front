<x-front-layout>
    <div class="{{ $page->lang === 'bangla' ? 'font-bangla' : '' }} container mx-auto rounded-md md:p-10 bg-white mt-5">
        <h1 class="text-center mb-6 text-2xl md:text-4xl font-extrabold leading-none tracking-tight text-gray-900">{{ $page->name }} <span class="text-blue-600 dark:text-blue-500"></span></h1>

        <div class="space-y-5 text-justify">
            {!! $page->content !!}
        </div>
    </div>
</x-front-layout>
