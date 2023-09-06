<x-front-layout>

    <section class="container mx-auto mt-5">
        @include('front.partials.home-caurosel')
    </section>

    <section class="mt-5">
        @include('front.partials.message-of-principal')
    </section>

    <section class="mt-5">
        <livewire:front.notice-list />
    </section>

    <section class="mt-5">
        @include('front.partials.pages-collection')
    </section>

</x-front-layout>

