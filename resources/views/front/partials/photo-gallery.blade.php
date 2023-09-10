@php 

    $home_gallery = \App\Models\Caurosel::published()->where('show_in_page', 'gallery')->first();

    $images = \App\Models\Slide::published()->where('caurosel_id', $home_gallery->id ?? 0)->paginate(9);

@endphp

@if($home_gallery)

<section class="text-gray-600 body-font">

  <div class="container px-5 py-24 mx-auto">

    <div class="flex flex-wrap -m-4">
      
        @foreach($images as $image)
            <div class="lg:w-1/3 sm:w-1/2 p-4">
                <div class="flex">
                    <img alt="gallery" class="w-full h-full object-cover object-center" src="{{ $image->imageUrl() }}">
                </div>
            </div>
        @endforeach

    </div>

    <div class="mt-5">
        {{ $images->links() }}
    </div>

  </div>
</section>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/viewerjs/viewer.css') }}">
    @endpush

    @push('scripts')
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
