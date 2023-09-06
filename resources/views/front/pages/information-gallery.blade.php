<x-front-layout>

    <section class="mt-5">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @php 
                    $pages = \App\Models\Page::published()->latest()->paginate(12);
                @endphp

                @foreach($pages as $page)
                    <div class="{{ $page->lang === 'bangla' ? 'font-bangla' : '' }} bg-white p-5 md:p-7 rounded-md">
                        <h1 class="mb-4 text-2xl text-transparent md:text-3xl bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400  font-extrabold leading-normal tracking-normal">{{ $page->name }}</h1>
                        <p class="mb-6 text-lg font-normal text-gray-500 ">{{ $page->excerpt }} @if($page->excerpt) ... @endif</p>
                        <a href="{{ route('page', ['page_slug' => $page->slug]) }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 bg-gradient-to-r hover:scale-105 to-emerald-600 from-sky-400 rounded-lg focus:ring-4 focus:ring-blue-300">
                            {{ $page->lang === 'bangla' ? 'বিস্তারিত' : 'Details' }}
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                @endforeach

            </div>

            @if($pages->total() > 12)
                <div class="mt-5">
                    {{ $pages->links() }}
                </div>
            @endif
        </div>
    </section>

</x-front-layout>

