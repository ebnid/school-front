<header class="bg-white font-bangla px-3 md:px-0 sticky top-0 z-40 shadow">
    <div class="container mx-auto">
        <nav class="flex items-center h-14 justify-between">

            <!-- Logo -->
            <h1>
                <a href="/" class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 flex flex-col">
                    <span class="text-sm md:text-xl font-bold">উচাখিলা উচ্চ বিদ্যালয় ও কলেজে</span>
                    <span class="text-xs">ইশ্বরগঞ্জ, ময়মনসিংহ।</span>
                </a>
            </h1>

            <!-- Menu -->
            <div class="ml-auto hidden lg:block">
                <ul class="flex text-md">

                    @php 

                        $menus = \App\Models\Menu::published()->where('parent_id', null)->orderBy('order')->get();

                    @endphp


                    @foreach($menus as $menu)

                        @php 

                            $children = \App\Models\Menu::published()->where('parent_id', $menu->id)->orderBy('order')->get();

                        @endphp 


                        @if(!count($children) > 0)
                            <li class="relative">
                                <a href="{{ $menu->link }}" class="text-purple-500 hover:text-white hover:bg-purple-600 font-bold py-2 px-3 block flex items-center gap-2">
                                    <span>{{ $menu->name }}</span>
                                </a>
                            </li>
                        @else 
                            <li class="relative group z-40">
                                <a class="cursor-pointer text-purple-500 hover:text-white hover:bg-purple-600 font-bold py-2 px-3 block flex items-center gap-1">
                                    <span>{{ $menu->name }}</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </a>

                                <ul class="group-hover:block absolute hidden top-full w-52 border rounded-md left-0 bg-white py-2 space-y-2">
                                    @foreach($children as $child)

                                        @php 

                                            $grandChildren = \App\Models\Menu::published()->where('parent_id', $child->id)->orderBy('order')->get();
                                        
                                        @endphp 

                                        @if(!count($grandChildren))
                                            <li id="child-menu-item" class="relative">
                                                <a href="{{ $child->link }}" class="text-purple-500 font-bold py-1 pl-4 block hover:text-white hover:bg-purple-600 flex items-center gap-2">
                                                    <span>{{ $child->name }}</span>
                                                </a>
                                            </li>
                                        @else 
                                            <li id="child-menu-item" class="relative">
                                                <a class="cursor-pointer text-purple-500 font-bold py-1 pl-4 block hover:text-white hover:bg-purple-600 flex items-center gap-2">
                                                    <span>{{ $child->name }}</span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                        </svg>
                                                    </span>
                                                </a>

                                                <ul class="grand-child-container absolute hidden top-0 left-full w-52 border rounded-md bg-white py-2 space-y-2">
                                                    @foreach($grandChildren as $grandChild)
                                                        <li>
                                                            <a href="{{ $grandChild->link }}" class="text-purple-500 font-bold py-1 pl-4 block hover:text-white hover:bg-purple-600 flex items-center gap-2">
                                                                <span>{{ $grandChild->name }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                    @endforeach
                </ul>
            </div>

            <!-- Menu Collapse Button -->
            <div class="ml-auto block lg:hidden flex items-center justify-center">
                <button @click="isNavigationOpen = !isNavigationOpen" x-show="!isNavigationOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>
                </button>
                <button @click="isNavigationOpen = !isNavigationOpen" x-show="isNavigationOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Login Links -->
            <div>
                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button"> 
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                        <li>
                            <a href="https://uchakhilahss.edu.bd/school_sas/automation/signin.php" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">School Login</a>
                        </li>
                        <li>
                            <a href="https://uchakhilahss.edu.bd/college_sas/automation/" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">College Login</a>
                        </li>
                        <li>
                            <a href="https://uchakhilahss.edu.bd/madrasah_sas/automation/signin.php" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Madrasah Login</a>
                        </li>
                        <li>
                            <a href="https://uchakhilahss.edu.bd/spm/" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Accounts Login</a>
                        </li>
                        <li>
                            <a href="https://uchakhilahss.edu.bd/teacher_login/signin.php" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Teacher's Login</a>
                        </li>
                        <li>
                            <a href="http://dstbd.connectbind.com/rsms/client-login.php?name=EBNHostBDis" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sms Login</a>
                        </li>
                        <li>
                            <a href="https://attendance.uchakhilahss.edu.bd/login" target="_blank" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Attendance Login</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Website Admin</a>
                    </div>
                </div>
            </div>

        </nav>
    </div>
</header class="block">


@push('scripts')
    <script>
        (function(){
            const childMenuItems = document.querySelectorAll('#child-menu-item');

            childMenuItems.forEach(menuItem => {
                menuItem.addEventListener('mouseenter', showChildItemHandeler);
                menuItem.addEventListener('mouseleave', hideChildItemHandeler);
            });

            function showChildItemHandeler(event){
                if(event.target.lastElementChild.classList.contains('grand-child-container')){
                    event.target.lastElementChild.classList.remove('hidden');
                    event.target.lastElementChild.classList.add('block');
                }
            }

            function hideChildItemHandeler(event){
                if(event.target.lastElementChild.classList.contains('grand-child-container')){
                    event.target.lastElementChild.classList.remove('block');
                    event.target.lastElementChild.classList.add('hidden');
                }
            }

        })()
    </script>
@endpush