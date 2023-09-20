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
                <button class="swiper-button-prev absolute w-10 h-10 right-10 top-1/2"></button>

                <button class="swiper-button-next absolute w-10 h-10 left-10 top-1/2"></button>
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
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                // nextButton: '.caurosel-next-btn',
                // prevButton: '.caurosel-next-btn',
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

        <script src="{{ asset('assets/jquery/jquery.slim.min.js') }}"></script>
        <script src="{{ asset('assets/viewerjs/viewer.js') }}"></script>

        <script>
            window.addEventListener('DOMContentLoaded', function () {

                let images = Array.from(document.querySelectorAll('img'));
                
                images.forEach(img => {

                    img.addEventListener('click', function (event) {
                        var image = new Image();

                        image.src = event.target.src;

                        var viewer = new Viewer(image, {
                            hidden: function () {
                                viewer.destroy();
                            },
                        });

                        // image.click();
                        viewer.show();
                    });

                })

            });
        </script>
    @endpush

@endif