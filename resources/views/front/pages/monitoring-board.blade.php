
@php 

    $isShowBanner = false;

@endphp

<x-front-layout :isShowBanner="$isShowBanner">

    <section class="container mx-auto mt-2 md:mt-5">
        @include('front.partials.monitoring-board-caurosel')
    </section>

</x-front-layout>

