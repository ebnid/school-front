<x-front-layout>

    @slot('banner')
        @include('front.partials.banner')
    @endslot
    
    <div class="mt-5">
        <livewire:front.notice-list />
    </div>
</x-front-layout>
