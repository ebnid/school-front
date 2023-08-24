<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Salary Details</title>


        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets//apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('assets/site.webmanifest') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Sweet Alert -->
        <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


    </head>
    <body>

        <div class="bg-white p-5 md:p-7 relative max-w-4xl mx-auto">

            <!-- Header-->
            <div>
                <h1 class="mb-2 text-center text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">EBN HOST LTD</h1>
                <h3 class="text-center text-sm">28/Ka, K.C Roy Road Kanchijhuli, Mymensingh - 2200, Bangladesh.</h3>
            </div>

            <div class="max-w-2xl mt-10">
                <div class="flow-root ">
                    <dl class="-my-3 text-md space-y-2">
                        <div class="grid grid-cols-1 gap-1  sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Name</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $employee->user->name ?? '' }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1  sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Organization</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $employee->organization->name ?? '' }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1  sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Designation</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $employee->designation->name ?? '' }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1  sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Salary Month</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $date ?? '---' }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1  sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Additional Bonous</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $bonous ?? '---' }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1  sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Over Paid Amount</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $overpaid ?? '---' }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1  sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Total Salary</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $salary ?? '---' }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1  sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Message</dt>
                            <dd class="text-gray-700 sm:col-span-2">{{ $message ?? '---' }}</dd>
                        </div>

                    </dl>
                </div>
            </div>
    


            <!-- Duties List -->
            @if(count($duties) > 0)
            <div class="mt-8 max-w-4xl mx-auto">
                <h1 class="text-center mb-5">Total Work Days</h1>
                <div class="relative overflow-x-auto">
                    <table class="whitespace-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="text-center">
                                <th scope="col" class="x-6 py-3">
                                    #
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Basic
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Late Deduct
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Early Left Deduct
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Overtime
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Day Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($duties ?? [] as $duty)
                            <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ ++$loop->index  }}
                                </th>
                                <td class="px-6 py-1">
                                    {{ $duty->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->dailySalrayAmount(), 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->lateDeductMoneyAmount(), 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->earlyLeaveMoneyDeductAmount(), 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->overtimeMoneyAmount(), 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->todayTotalSalary(), 2) }}
                                </td>
                            </tr>
                            @endforeach

                            <tr class="group font-bold text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Total
                                </th>
                                <td class="px-6 py-1">
                                    
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty_total_basic, 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty_total_late_deduct, 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty_total_early_left_deduct, 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty_total_overtime, 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty_total_salary, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif


            <!--Replace Duties List -->
            @if(count($replace_duties) > 0)
            <div class="mt-8 max-w-4xl mx-auto">
                <h1 class="text-center mb-5">Total Replace/Overtime Work Days</h1>
                <div class="relative overflow-x-auto">
                    <table class="whitespace-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="text-center">
                                <th scope="col" class="x-6 py-3">
                                    #
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Basic
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Late Deduct
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Early Left Deduct
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Overtime
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Day Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($replace_duties ?? [] as $duty)
                            <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ ++$loop->index  }}
                                </th>
                                <td class="px-6 py-1">
                                    {{ $duty->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->dailySalrayAmount(), 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->lateDeductMoneyAmount(), 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->earlyLeaveMoneyDeductAmount(), 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->overtimeMoneyAmount(), 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($duty->todayTotalSalary(), 2) }}
                                </td>
                            </tr>
                            @endforeach
                        
                            <tr class="group font-bold text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Total
                                </th>
                                <td class="px-6 py-1">
                                    
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($replace_total_basic, 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($replace_total_late_deduct, 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($replace_total_early_left_deduct, 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($replace_total_overtime, 2) }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($replace_total_salary, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif


            <!--Withdraws List -->
            @if(count($withdraws) > 0)
            <div class="mt-8 max-w-sm mx-auto">
                <h1 class="text-center mb-5">Total Withdraw Amount</h1>
                <div class="relative overflow-x-auto">
                    <table class="whitespace-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="text-center">
                                <th scope="col" class="x-6 py-3">
                                    #
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdraws ?? [] as $withdraw)
                            <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ ++$loop->index  }}
                                </th>
                                <td class="px-6 py-1">
                                    {{ $withdraw->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($withdraw->amount, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        
                            <tr class="group font-bold text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Total
                                </th>
                                <td class="px-6 py-1">
                                    
                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($withdraw_total_amount, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif


            <!--Withdraws List -->
            @if(count($duties) > 0)
            <div class="mt-8 max-w-sm mx-auto pb-20">
                <h1 class="text-center mb-5">Final Salary</h1>
                <div class="relative overflow-x-auto">
                    <table class="whitespace-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Purpose
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    1
                                </th>
                                <td class="px-6 py-1">
                                    Duty Salary
                                </td>
                                <td class="px-6 py-1 text-right">
                                    {{ number_format($duty_total_salary, 2) }}
                                </td>
                            </tr>

                            <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    2
                                </th>
                                <td class="px-6 py-1">
                                    Replace Duty Salary
                                </td>
                                <td class="px-6 py-1 text-right">
                                    {{ number_format($replace_total_salary, 2) }}
                                </td>
                            </tr>

                            <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    3
                                </th>
                                <td class="px-6 py-1">
                                    Withdraw Amount
                                </td>
                                <td class="px-6 py-1 text-right">
                                    -{{ number_format($withdraw_total_amount, 2) }}
                                </td>
                            </tr>

                            <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    4
                                </th>
                                <td class="px-6 py-1">
                                    Previous Over Paid
                                </td>
                                <td class="px-6 py-1 text-right">
                                    -{{ number_format($total_previous_overpaid, 2) }}
                                </td>
                            </tr>

                            <tr class="group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    5
                                </th>
                                <td class="px-6 py-1">
                                    Additional Bonous
                                </td>
                                <td class="px-6 py-1 text-right">
                                  {{ number_format($additional_bonous, 2) }}
                                </td>
                            </tr>
        

                            <tr class="group font-bold text-black bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Total
                                </th>
                                <td class="px-6 py-1">

                                </td>
                                <td class="px-6 py-1">
                                    {{ number_format($total_monthly_salary, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            @endif

        </div>

    </body>
</html>
