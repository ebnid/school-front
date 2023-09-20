@php 

    $home_gallery = \App\Models\Caurosel::published()->where('show_in_page', 'gallery')->first();

    $images = \App\Models\Slide::published()->where('caurosel_id', $home_gallery->id ?? 0)->paginate(12);

@endphp

@if($home_gallery)

<section class="text-gray-600 body-font">

  <div class="container px-5 py-16 mx-auto">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
      
        @foreach($images as $image)
            <div>
                <img class="h-auto max-w-full rounded-lg" src="{{ $image->imageUrl() }}" alt="">
                @if($image->details)
                    <p class="font-bangla mt-5">{{ $image->details ?? '' }}</p>
                @endif
            </div>
        @endforeach

    </div>

    <div class="mt-10">
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
