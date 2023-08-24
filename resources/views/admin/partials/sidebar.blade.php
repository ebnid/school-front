<aside x-cloak :class="isNavigationOpen ? 'visible translate-x-0' : 'invisible translate-x-full' " class="transition-all fixed z-40 top-0 bottom-0 right-0  md:translate-x-0 md:visible md:left-0 w-5/6 md:w-52 bg-gray-900 text-white aside-scroll-bar overflow-y-auto">
    
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                </svg>
            </span>

            <span>
                Attendances
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
            <a href="{{ route('attendence.give') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Give Attendance
            </a>
            <a href="{{ route('attendence.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Create Attendance
            </a>

            @canany(['admin', 'root'])
                <a href="{{ route('attendence.create-leave') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    Create Leave
                </a>
            @endcanany

            <a href="{{ route('attendence.create-edit-leave-request-list') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Leave Request
            </a>
            
            @canany(['admin', 'root'])
                <a href="{{ route('attendence.leave-request-list') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    Leave Request List
                </a>
            @endcanany

            <a href="{{ route('attendence.all-list') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Attendacne List
            </a>
        </div>
    </div>


    @canany(['admin', 'root'])
        <div x-data="{isOpen: false}">
            <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
                <span class="mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </span>

                <span>
                    Employees
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
                <a href="{{ route('employee.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    Add New
                </a>
                <a href="{{ route('employee.list') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    Employee List
                </a>
            </div>
        </div>
    @endcanany

    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>
            </span>

            <span>
                Salaries
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
            <a href="{{ route('salary.create') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Salary
            </a>
            <a href="{{ route('salary.withdraw') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Withdraw
            </a>
            @canany(['admin', 'root'])
            <a href="{{ route('salary.withdraw-request-list') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Withdraw Request
            </a>
            @endcanany
            <a href="{{ route('salary.history') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Salary History
            </a>
        </div>
    </div>


    @canany(['admin', 'root'])

    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
            </span>

            <span>
                Expanses
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
            <a href="" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Add
            </a>
            <a href="" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                List
            </a>
        </div>
    </div>

    @endcanany


    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                </svg>
            </span>
            <span>
                Tasks
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
            <a href="" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Add
            </a>
            <a href="" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                List
            </a>
        </div>
    </div>


    <div x-data="{isOpen: false}">
        <a @click="isOpen = !isOpen" class="cursor-pointer flex items-center py-2 px-3 hover:bg-gray-800" >
            <span class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
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
            <a href="" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                Add
            </a>
            <a href="" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                List
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
            @canany(['admin', 'root'])
                <a href="{{ route('profile.delete') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    Delete Account
                </a>
            @endcanany
        </div>
    </div>

    

    @canany(['root', 'admin'])
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
                <a href="{{ route('setting.organization') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    Organization
                </a>
                <a href="{{ route('setting.designation') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    Designation
                </a>
                <a href="{{ route('setting.shift') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    Shift
                </a>
                <a href="{{ route('setting.general') }}" class="border-l cursor-pointer flex items-center text-sm py-1 px-3 hover:bg-gray-700" >
                    General
                </a>
            </div>
        </div>
    @endcanany


</aside>