@php 

    $home_gallery = \App\Models\Caurosel::published()->where('show_in_page', 'gallery')->first();

    $images = \App\Models\Slide::published()->where('caurosel_id', $home_gallery->id ?? 0)->paginate(9);

@endphp

@if($home_gallery)
    <div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-5">
            @foreach($images as $image)
                <div>
                    <a href="{{ $image->link }}"><img class="h-auto max-w-full rounded-lg" src="{{ $image->imageUrl('square') }}" alt=""></a>
                </div>
            @endforeach
        </div>
        <div class="mt-5">
            {{ $images->links() }}
        </div>
    </div>
@endif
