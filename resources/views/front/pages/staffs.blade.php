<x-front-layout>

    @slot('banner')
        @include('front.partials.banner')
    @endslot
    
    <section class="mt-5">
        <livewire:front.staff-list />
    </section>
</x-front-layout>
