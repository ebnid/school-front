<x-front-layout>
    <section class="mt-5">
        <div class="container mx-auto">
            <div class="bg-white md:p-7 font-bangla  py-5 md:py-16">
               <div class="max-w-3xl mx-auto">
                    <h1 class="text-4xl font-extrabold text-center">নোটিশ</h1>
                    <h1 class="text-3xl mt-7 text-sky-900 font-extrabold text-center">{{ $notice->name ?? '' }}</h1>
                    <p class="mt-5">{{ $notice->created_at->format('d M Y h:i A') }}</p>
                    <p class="text-lg">{!! $notice->content ?? '' !!}</p>
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
            </div>
        </div>
    </section>
    <section class="mt-5">
        @include('front.partials.pages-collection')
    </section>
</x-front-layout>
