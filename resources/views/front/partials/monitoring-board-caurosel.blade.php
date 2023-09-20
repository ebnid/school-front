@php 

    $home_caurosel = \App\Models\Caurosel::published()->where('show_in_page', 'monitoring-board')->first();

    $images = \App\Models\Slide::published()->where('caurosel_id', $home_caurosel->id ?? null)->get();

@endphp

@if($home_caurosel)

    <div class="bg-white md:p-5">
        <div class="swiper max-container mx-auto relative" id="home-caurosel">
            <div class="swiper-wrapper">

                @foreach($images as $image)
                    <div class="swiper-slide">
                        <a><img src="{{ $image->imageUrl() }}" class="cursor-pointer w-full max-h-screen object-contain" alt="image" /></a>
                    </div>
                @endforeach

            </div>
                <button class="caurosel-prev-btn absolute w-10 h-10 rgiht-10 top-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </button>

                <button class="caurosel-next-btn absolute w-10 h-10 left-10 top-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
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
                //     nextEl: '.caurosel-next-btn',
                //     prevEl: '.caurosel-prev-btn',
                // },
                nextButton: '.caurosel-next-btn',
                prevButton: '.caurosel-next-btn',
                slidesPerView: 1, // Number of slides visible in the viewport
                spaceBetween: 20,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                autoplay: {
                    delay: 30000, // Delay between slide changes in milliseconds (e.g., 3000ms = 3 seconds)
                    disableOnInteraction: false, // Allow autoplay to continue even when the user interacts with the slider (true by default)
                },
            });
        </script>

    @endpush

@endif