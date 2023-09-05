<x-front-layout>
    <section class="mt-5">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-5">
                <div class="col-span-3">
                    <div class="bg-white md:p-7 font-bangla">
                        <h1 class="text-4xl font-extrabold text-center">নোটিশ</h1>
                        <h1 class="text-3xl mt-7 text-blue-600 font-extrabold text-center">{{ $notice->name ?? '' }}</h1>
                        <p class="mt-5">{{ $notice->created_at->format('d M Y h:i A') }}</p>
                        <p class="mt-4 text-lg">{!! $notice->content ?? '' !!}</p>
                    </div>
                </div>
                <div class="col-span-2">
                    @include('front.partials.message-of-principal')
                </div>
            </div>
        </div>
    </section>
    @include('front.partials.pages-collection')
</x-front-layout>
