<aside x-cloak :class="isNavigationOpen ? 'visible translate-x-0' : 'invisible translate-x-full' " class="transition-all fixed z-40 top-0 bottom-0 right-0  md:translate-x-0 md:visible md:left-0 w-5/6 md:w-52 bg-gray-900 text-white aside-scroll-bar overflow-y-auto">
    
    <div x-data="{isOpen: false}">
        <a href="/" target="_blank" @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                </svg>
            </span>

            <span>
                Front
            </span>
        </a>
    </div>

    <div x-data="{isOpen: false}">
        <a href="{{ route('dashboard') }}" @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </span>

            <span>
                Dashboard
            </span>
        </a>
    </div>


    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </span>

            <span>
                Gallery & Slide
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
            <a href="{{ route('caurosels.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Add/List
            </a>
        </div>
    </div>


    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </span>

            <span>
                Attendance Report
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
            <a href="{{ route('attendances.import') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Import
            </a>
            <a href="{{ route('attendances.teachers') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Teacher Wise
            </a>
            <a href="{{ route('attendances.summary') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Summery
            </a>
        </div>
    </div>

    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
                </svg>
            </span>

            <span>
                Announcement
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
            <a href="{{ route('announcement.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Add/List
            </a>
        </div>
    </div>


    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
            </span>

            <span>
                Teacher/Staff
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
            <a href="{{ route('teacher-staffs.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Add
            </a>
            <a href="{{ route('teacher-staffs.list') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                List
            </a>
        </div>
    </div>

    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
            </span>
            <span>
                Notices
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

            <a href="{{ route('notices.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Add/List
            </a>
            
        </div>
    </div>

    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </span>

            <span>
                Profile
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
            <a href="{{ route('profile.profile') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                My Profile
            </a>
            
            <a href="{{ route('profile.security') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Security
            </a>

            <a href="{{ route('profile.delete') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Delete Account
            </a>

        </div>
    </div>

    


    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>

            <span>
                Settings
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
            <a href="{{ route('setting') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                General
            </a>
            <a href="{{ route('admins.list') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Admins
            </a>
            <a href="{{ route('guides.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Guides
            </a>
            <a href="{{ route('menus.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Menus
            </a>
            <a href="{{ route('pages.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Pages
            </a>
            <a href="{{ route('socials.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Socials
            </a>
            <a href="{{ route('footers.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Footer
            </a>
        </div>
    </div>



</aside>