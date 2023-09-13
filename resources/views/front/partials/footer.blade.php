@php 

    $name_lang = \App\Models\Setting::where('name', 'name_lang')->first()->value;
    $email = \App\Models\Setting::where('name', 'email')->first()->value;
    $mobile = \App\Models\Setting::where('name', 'mobile')->first()->value;

    $school_name = null;
    $school_address = null;

    if($name_lang === 'bangla'){
        $school_name = \App\Models\Setting::where('name', 'name_bn')->first()->value;
        $school_address = \App\Models\Setting::where('name', 'address_bn')->first()->value;
    }
    
    if($name_lang === 'english'){
        $school_name = \App\Models\Setting::where('name', 'name_en')->first()->value;
        $school_address = \App\Models\Setting::where('name', 'address_en')->first()->value;
    }
   
@endphp



<footer class="bg-sky-900 mt-5 text-white font-bangla">
    <div class="mx-auto max-w-screen-xl space-y-8 px-4 py-16 sm:px-6 lg:space-y-16 lg:px-8">

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
          
          <div class="flex flex-col items-center">
            
              <h1 class="{{ $name_lang === 'bangla' ? 'text-2xl' : 'text-xl text-center'}} text-2xl ">{{ $school_name }}</h1>

              <p>{{ $school_address }}</p>

              <p class="mt-4 max-w-xs text-white">
                {{ $email }}
              </p>

              <p class="mt-4 max-w-xs text-white">
                Call: {{ $mobile }}
              </p>

            <ul class="mt-8 flex gap-6">

              @php 

                    $socilas = \App\Models\SocialLink::published()->get();

              @endphp
            
                @foreach($socilas as $social)
                  <li>
                      <a
                        href="{{ $social->link }}"
                        rel="noreferrer"
                        target="_blank"
                        class="text-white transition hover:opacity-75"
                      >
                        <span class="sr-only">{{ $social->name }}</span>
                        <img src="{{ $social->iconUrl() }}" class="w-10 h-10" alt="">
                      </a>
                  </li>
                @endforeach
                </ul>
          </div>

          <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:col-span-2 lg:grid-cols-4">
              @php 
                    
                    $footer_columns = \App\Models\FooterColumn::published()->get();

              @endphp

              @foreach($footer_columns as $footer_column)
                <div>
                  <p class="font-medium text-white">{{ $footer_column->column_title }}</p>

                  <ul class="mt-6 space-y-4 text-sm">
                    @php 
                      
                        $columns_attributes = \App\Models\FooterColumnAttribute::published()->where('footer_column_id', $footer_column->id)->get();

                    @endphp

                    @foreach($columns_attributes as $columns_attribute)
                      <li>
                        <a href="{{ $columns_attribute->link }}" class="text-gray-50 transition hover:opacity-75">
                          {{ $columns_attribute->name }}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              @endforeach
          </div>

      </div>

      <p class="text-xs text-white">
        &copy; {{ date('Y') }}. {{ request()->getHttpHost() }}. All rights reserved.
      </p>

    </div>
</footer>