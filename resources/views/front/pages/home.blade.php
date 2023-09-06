<x-front-layout>

    <section class="container mx-auto mt-5">
        @include('front.partials.home-caurosel')
    </section>

    <section class="mt-5">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-5">
                <div class="col-span-3">
                    <livewire:front.notice-list />
                </div>
                <div class="col-span-2">
                    @include('front.partials.message-of-principal')
                </div>
            </div>
        </div>
    </section>
    @include('front.partials.pages-collection')
</x-front-layout>

