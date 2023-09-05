

@php 
    $announcments = \App\Models\Announcement::published()->latest()->orderBy('order')->take(10)->get();
@endphp

@if(count($announcments) > 0)

    <div>
        <marquee id="announcement-tickle" class="font-bangla text-xl text-amber-400" behavior="" direction="">
            <div>
                @foreach($announcments as $announcment)
                    @if($announcment->link)
                        <a class="hover:underline" href="{{ $announcment->link }}">* {{ $announcment->announce }}</a>
                    @else 
                        <a>* {{ $announcment->announce }}</a>
                    @endif
                @endforeach
            </div>
        </marquee>
    </div>



    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const marquee = document.getElementById('announcement-tickle');

                marquee.addEventListener('mouseover', () => {
                    marquee.stop();
                });

                marquee.addEventListener('mouseout', () => {
                    marquee.start();
                });

            });
        </script>
    @endpush

@endif
