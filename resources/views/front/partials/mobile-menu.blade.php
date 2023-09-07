<aside x-cloak :class="isNavigationOpen ? 'visible translate-x-0' : 'invisible translate-x-full' " class="font-bangla transition-all fixed z-40 top-0 bottom-0 right-0  w-5/6 bg-sky-800 border-l border-sky-900 text-white aside-scroll-bar overflow-y-auto">
    
    <div @click="isNavigationOpen = !isNavigationOpen" class="absolute right-4 top-2 w-7 h-7">
        <span class="mr-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </span>
    </div>


    

    <div>
        <a href="/" @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </span>
        </a>
    </div>
    
    @php 

        $menus = \App\Models\Menu::published()->where('parent_id', null)->orderBy('order')->get();

    @endphp


    @foreach($menus as $menu)

        @php 

            $children = \App\Models\Menu::published()->where('parent_id', $menu->id)->orderBy('order')->get();

        @endphp 

        @if(!count($children) > 0)
            <div>
                <a href="{{ $menu->link }}" class="cursor-pointer flex items-center py-2 px-3 hover:bg-sky-900 hover:text-white" >
                    <span>
                        {{ $menu->name }}
                    </span>
                </a>
            </div>
        @else 
            <div x-data="{isOpen: false}">
                <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-sky-900 hover:text-white" >
                    
                    <span>
                        {{ $menu->name }}
                    </span>

                    <span x-show="!isOpen" class="ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>

                    <span x-show="isOpen" class="ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                    </span>
                </a>


                <div x-transition.duration.150ms x-show="isOpen" class="pl-7">
                    @foreach($children as $child)

                    
                        @php 

                            $grandChildren = \App\Models\Menu::published()->where('parent_id', $child->id)->orderBy('order')->get();

                        @endphp 

                        <a href="{{ $child->link }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-sky-900 hover:text-white" >
                            {{ $child->name }}
                        </a>

                        @foreach($grandChildren as $grandChild)
                            <a href="{{ $grandChild->link }}" class="ml-3 border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-sky-900 hover:text-white" >
                                {{ $grandChild->name }}
                            </a>
                        @endforeach

                    @endforeach
                </div>
            </div>
        @endif

    @endforeach

</aside>