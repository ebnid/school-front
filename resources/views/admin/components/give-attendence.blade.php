<div class="bg-white p-5 md:p-10 max-w-2xl mx-auto md:rounded-sm relative">

    <!-- Early Time Alert -->
    @if($tooEarlyTime && $isThisDeviceAllowed)
        <div class="p-4 text-center mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span class="font-medium">Too early ! Your shift is start after {{ $tooEarlyTime }} minutes later at {{ $employee->shift->start_at->format('h:i A') }}</span>
        </div>
    @elseif(!$isThisDeviceAllowed)
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Your device is not allowed !</span>
        </div>
    @endif

    <!-- Tody Date Heading -->
    <h3 class="text-center text-xl md:text-3xl dark:text-white">{{ now()->format('d M Y, h:i A') }}</h3>

    <!-- Present Button -->
    @if($isThisDeviceAllowed && !$tooEarlyTime && !$todayAttendance)
        <div wire:click.debounce="officeInHandeler" class="flex justify-center py-6 md:my-10">
            <div class="transition-transform hover:scale-105 w-20 h-20 md:w-32 md:h-32 ring-4 ring-gray-600 bg-gray-800 cursor-pointer flex items-center justify-center rounded-full">
                <img src="{{ asset('assets/images/finger-touch.png') }}" class="w-14 h-14 md:w-20 md:h-20 block">
            </div>
        </div>
    @elseif($isThisDeviceAllowed && $todayAttendance)
        @if( !( $todayAttendance->in_at && $todayAttendance->out_at ) )
            <div wire:click.debounce="handleOfficeExit" class="flex justify-center py-6 md:my-10">
                <div class="transition-transform hover:scale-105 w-20 h-20 md:w-32 md:h-32 ring-4 ring-gray-600 bg-gray-800 cursor-pointer flex items-center justify-center rounded-full">
                    <img src="{{ asset('assets/images/exit-icon.png') }}" class="w-14 h-14 md:w-20 md:h-20 block">
                </div>
            </div>
        @endif
    @else 
        <!-- Not Allowed -->
        <div class="flex justify-center py-6 md:my-10">
            <div class="transition-transform hover:scale-105 w-20 h-20 md:w-32 md:h-32 ring-4 ring-gray-600 bg-gray-800 cursor-pointer flex items-center justify-center rounded-full">
                <img src="{{ asset('assets/images/device-not-allowed.png') }}" class="w-14 h-14 md:w-20 md:h-20 block">
            </div>
        </div>
    @endif



    <!-- Employee Details -->
    <div class="mt-8">
        <div class="flow-root">
            <dl class="-my-3 divide-y divide-gray-100 text-sm">
                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Name</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $employee->user->name ?? 'Unknown' }}</dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Designation</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $employee->designation->name ?? 'Unknown' }}</dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Organization</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $employee->organization->name ?? 'Unknown' }}</dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Shift</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $employee->shift->name ?? 'Unknown' }}</dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Start at</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $employee->shift->start_at->format('h:i A') ?? 'Unknown' }}</dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">End at</dt>
                    <dd class="text-gray-700 sm:col-span-2">{{ $employee->shift->end_at->format('h:i A') ?? 'Unknown' }}</dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Reach at</dt>
                    <dd class="text-gray-700 sm:col-span-2">
                        @if($todayAttendance->in_at ?? false)
                            {{ $todayAttendance->in_at->format('h:i A') }}
                        @else 
                            N/A
                        @endif
                    </dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Leave at</dt>
                    <dd class="text-gray-700 sm:col-span-2">
                        @if($todayAttendance->out_at ?? false)
                            {{ $todayAttendance->out_at->format('h:i A') }}
                        @else 
                            N/A
                        @endif
                    </dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Early Leave Min/Deduct</dt>
                    <dd class="text-gray-700">
                        @if($todayAttendance->early_out_time ?? false && $todayAttendance->out_at ?? false)
                            {{ $todayAttendance->early_out_time ?? 0 }} minutes
                        @else
                            N/A
                        @endif
                    </dd>
                    <dd class="text-gray-700">
                        @if($todayAttendance->early_out_time ?? false )
                            @if($todayAttendance->early_out_type === \App\Models\Attendance::EARLY_OUT_TYPE_NON_PAYABLE)
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"> -{{ number_format($todayAttendance->earlyLeaveMoneyDeductPercent(), 2) }}%</span>
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">BDT -{{ number_format($todayAttendance->earlyLeaveMoneyDeductAmount(), 2) }}</span>
                            @endif
                        @endif
                    </dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Late</dt>
                    <dd class="text-gray-700">
                        @if($todayAttendance->late_time ?? false)
                            {{ $todayAttendance->late_time }} minutes
                        @else 
                            N/A
                        @endif
                    </dd>
                    <dd class="text-gray-700">
                        @if($todayAttendance->late_time ?? false)
                            @if($todayAttendance->late_type === \App\Models\Attendance::LATE_TYPE_NON_PAYABLE)
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"> -{{ number_format($todayAttendance->lateDeductMoneyPercent(), 2) }}%</span>
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">BDT -{{ number_format($todayAttendance->lateDeductMoneyAmount(), 2) }}</span>
                            @endif
                        @endif
                    </dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Overtime</dt>
                    <dd class="text-gray-700">
                        @if($todayAttendance->overtime ?? false)
                            {{ $todayAttendance->overtime ? $todayAttendance->overtime . ' minutes'  : 'N/A' }}
                        @else 
                            N/A
                        @endif
                    </dd>
                    <dd class="text-gray-700">
                        @if($todayAttendance->overtime ?? false)
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">+{{ number_format($todayAttendance->overtimeMoneyAmountPercent(), 2) }}%</span>
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">BDT +{{ number_format($todayAttendance->overtimeMoneyAmount(), 2) }}</span>
                        @endif
                    </dd>
                </div>

                <div class="grid grid-cols-3 gap-1 py-3 sm:grid-cols-3 sm:gap-4">
                    <dt class="font-medium text-gray-900">Today Income</dt>
                    <dd class="text-gray-700">
                        @if($todayAttendance && $todayAttendance->out_at ?? false)
                            BDT {{ number_format($todayAttendance->todayTotalSalary(), 2) }}
                        @else 
                            N/A
                        @endif
                    </dd>
                    <dd class="text-gray-700">
                        @if($todayAttendance)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    {{ number_format($todayAttendance->dailySalrayAmount() ?? 0, 2) }}
                            </span>
                        @endif

                        @if($todayAttendance->overtime ?? false)
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"> +{{ number_format($todayAttendance->overtimeMoneyAmount(), 2) }}</span>
                        @endif

                        @if($todayAttendance->late_time ?? false)
                            @if($todayAttendance->late_type === \App\Models\Attendance::LATE_TYPE_NON_PAYABLE)
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"> -{{ number_format($todayAttendance->lateDeductMoneyAmount(), 2) }}</span>
                            @endif
                        @endif

                        @if($todayAttendance->early_out_time ?? false)
                            @if($todayAttendance->early_out_type === \App\Models\Attendance::EARLY_OUT_TYPE_NON_PAYABLE)
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"> -{{ number_format($todayAttendance->earlyLeaveMoneyDeductAmount(), 2) }}</span>
                            @endif
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>


    <!-- Loading Processing Indicator -->
    <div wire:loading class="absolute inset-0 w-full h-full cursor-wait" style="background-color: rgba(0, 0, 0, .6)">
        <div class="w-auto h-auto absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 p-2 text-white">
            Processing...
        </div>
    </div>
    
</div>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            window.addEventListener('init:scanner', function() {
                initScanner();
                focusInit();
            });

            initScanner();
            focusInit();
        });


        function focusInit(){
            document.addEventListener('click', function(){
                document.getElementById('scanner').focus();
            })
        }

        function initScanner()
        {
            document.getElementById('scanner').focus();
        }

    </script>
@endpush