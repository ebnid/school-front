@php 

    $home_caurosel = \App\Models\Caurosel::published()->where('show_in_page', 'home-caurosel')->first();

    $images = \App\Models\Slide::published()->where('caurosel_id', $home_caurosel->id ?? null)->get();

@endphp

@if($home_caurosel)

    <div class="bg-white md:p-5">
        <div class="swiper max-container mx-auto" id="home-caurosel">
            <div class="swiper-wrapper">

                @foreach($images as $image)
                    <div class="swiper-slide">
                        <a href="{{ $image->link }}"><img src="{{ $image->imageUrl() }}" class="w-full max-h-96 object-cover" alt="image" /></a>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/swiper/swiper-bundle.min.css') }}">
    @endpush

    @push('scripts')

        <script src="{{ asset('assets/swiper/swiper-bundle.min.js') }}" ></script>

        <script>
            const swiper1 = new Swiper("#home-caurosel", {
                // navigation: {
                //     nextEl: '.swiper-button-next-ex1',
                //     prevEl: '.swiper-button-prev-ex1',
                // },
                slidesPerView: 1, // Number of slides visible in the viewport
                spaceBetween: 20,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                autoplay: {
                    delay: 3000, // Delay between slide changes in milliseconds (e.g., 3000ms = 3 seconds)
                    disableOnInteraction: false, // Allow autoplay to continue even when the user interacts with the slider (true by default)
                },
            });
        </script>

    @endpush

@endif