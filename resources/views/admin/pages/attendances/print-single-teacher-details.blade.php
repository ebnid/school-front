@php 

    function getDaysOfMonth($year, $month) {

        if ($month < 1 || $month > 12) {
            return []; // Invalid month input
        }

        // Get the total number of days in the given month
        $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Initialize an array to store the formatted dates
        $dates = [];

        // Loop through each day and format it as 'Y-m-d'
        for ($day = 1; $day <= $numDays; $day++) {
            $formattedDate = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
            $dates[] = $formattedDate;
        }

        return $dates;
    }


    function getDayName($date) {
        // Convert the date to a UNIX timestamp
        $timestamp = strtotime($date);

        // Get the day name using the 'l' format specifier
        $dayName = date('l', $timestamp);

        return $dayName;
    }

    function getYear($date) {

        $dateTime = DateTime::createFromFormat('Y-m-d', $date);

        if ($dateTime === false) {
            return null; // Invalid date format
        }

        return (int)$dateTime->format('Y');

    }

    function getMonth($date) {

        $dateTime = DateTime::createFromFormat('Y-m-d', $date);

        if ($dateTime === false) {
            return null; // Invalid date format
        }

        return (int)$dateTime->format('m');
    }

    function getDay($date) {

        $dateTime = DateTime::createFromFormat('Y-m-d', $date);

        if ($dateTime === false) {
            return null; // Invalid date format
        }

        return (int)$dateTime->format('d');
    }


    function isLeaveToday($day)
    {
        return in_array($day, config('leave.leave_days'));
    }

    function getMonthName($monthNumeric) {
        $months = array(
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        );

        if (array_key_exists($monthNumeric, $months)) {
            return $months[$monthNumeric];
        } else {
            return '';
        }
    }


    $target_month = request()->month;
    $target_year = request()->year;
    $target_teacher_name = request()->name;


    $school_name = \App\Models\Setting::where('name', 'name_en')->first()->value;
    $school_address = \App\Models\Setting::where('name', 'address_en')->first()->value;

@endphp

<!DOCTYPE html>
<html>
    <head>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            table {
                border-collapse: collapse;
                border: 1px solid #000; /* Set border width to 1px */
                padding: 1px; /* Set minimal padding */
            }
            td,th {
                border: 1px solid #000; /* Set border width to 1px for cells */
                padding: 2px; /* Set minimal cell padding */
                font-size: 14px; /* Set font size to 10px */
            }

            .vertical-center {
                vertical-align: middle;
            }

        </style>
    </head>
<body>
    <main class="max-w-4xl mx-auto pb-10">

        <h1 class="text-center font-bold text-2xl mt-7">{{ $school_name }}</h1>
        <h3 class="text-center text-xl mt-3">{{ $school_address }}</h3>

        <h2 class="text-center text-2xl mt-3">Attendance Report of {{ $target_teacher_name }}, {{ getMonthName($target_month) }}-{{ $target_year }}</h2>

        <table class="mt-6 w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Late</th>
                    <th>Worktime</th>
                </tr>
            </thead>
            <tbody>
                @foreach(getDaysOfMonth($target_year, $target_month) as $date)

                    @php 
                        $attendance = \App\Models\Attendance::whereDate('date', $date)->where('name', $target_teacher_name)->first();
                    @endphp

                    @if($attendance)
                        <tr>
                            <td class="text-center vertical-center px-2">{{ ++$loop->index }}</td>
                            <td class="whitespace-nowrap text-center vertical-center px-2">@if($attendance->date) {{ $attendance->date->format('d M Y') }} @endif</td>
                            <td class="whitespace-nowrap text-center vertical-center px-2">@if($attendance->date) {{ $attendance->date->format('l') }} @endif</td>
                            <td class="whitespace-nowrap text-center vertical-center px-2">@if($attendance->clock_in) {{ $attendance->clock_in->format('h:i A') }} @else x @endif</td>
                            <td class="whitespace-nowrap text-center vertical-center px-2">@if($attendance->clock_out) {{ $attendance->clock_out->format('h:i A') }} @else x @endif</td>
                            <td class="whitespace-nowrap text-center vertical-center px-2">@if($attendance->late) {{ $attendance->late ?? '0' }}min @else x @endif</td>
                            <td class="whitespace-nowrap text-center vertical-center px-2">@if($attendance->worktime) {{ $attendance->worktime ?? '0' }}min @else x @endif</td>
                        </tr>
                    @else
                        @if(isLeaveToday(getDayName($date)))
                            <tr>
                                <td class="text-center vertical-center px-2">{{ ++$loop->index }}</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">{{ getDayName($date) }}</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">Off Day</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">Off Day</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">Off Day</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">Off Day</td>
                            </tr>
                        @else 
                            <tr>
                                <td class="text-center vertical-center px-2">{{ ++$loop->index }}</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">{{ getDayName($date) }}</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">x</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">x</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">x</td>
                                <td class="whitespace-nowrap text-center vertical-center px-2">x</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>

        </table>
    </mian>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.print();
        });
    </script>
</body>
</html>


