
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


    $teaders_list = \App\Models\Attendance::select('name')->groupBy('name')->get();

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
                font-size: 9px; /* Set font size to 10px */
            }

            .vertical-center {
                vertical-align: middle;
            }

        </style>
    </head>
<body>
    <main class="mx-auto">

        <h1 class="text-center font-bold text-5xl mt-10">{{ $school_name }}</h1>
        <h3 class="text-center text-3xl mt-3">{{ $school_address }}</h3>

        <h2 class="text-center text-4xl mt-5">Teacher & Staff Attendance Report, {{ getMonthName($target_month) }}-{{ $target_year }}</h2>

        <table class="mt-10">
            <thead>
                <tr>
                    <th rowspan="2" clas="text-lg">#</th>
                    <th rowspan="2" class="text-lg">Teacher Name</th>
                    @foreach(getDaysOfMonth($target_year, $target_month) as $date)
                        <th class="text-md">{{ \Carbon\Carbon::parse($date)->format('d M y') }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach(getDaysOfMonth($target_year, $target_month) as $date)
                        <th>{{ getDayName($date) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($teaders_list as $_teacher)
                    <tr>
                        <td class="text-lg">{{ ++$loop->index }}</td>
                        <td class="whitespace-nowrap text-center vertical-center vertical-center text-lg px-2">{{ $_teacher->name }}</td>
                        @foreach(getDaysOfMonth($target_year, $target_month) as $date)

                            @php 
                                 // $attendance = \App\Models\Attendance::whereYear('date', getYear($date))->whereMonth('date', getMonth($date))->whereDay('date', getDay($date))->where('name', $_teacher->name)->first();
                                $attendance = \App\Models\Attendance::whereDate('date', $date)->where('name', $_teacher->name)->first();
                            @endphp

                           
                                @if($attendance)
                                    <td class="whitespace-nowrap ">
                                        <span class="block">In - @if($attendance->clock_in) {{ $attendance->clock_in->format('h:i A') }} @endif</span>
                                        <span class="block">Out -  @if($attendance->clock_out) {{ $attendance->clock_out->format('h:i A') }} @endif</span>
                                        <span class="block">Late -  </span>
                                        <span class="block">Work -  </span>
                                    </td>
                                @else 
                                    <td class="whitespace-nowrap text-center">
                                        @if(isLeaveToday(getDayName($date)))
                                            {{ getDayName($date) }}
                                        @else 
                                            X
                                        @endif
                                    </td>
                                @endif
                           
                        @endforeach
                    </tr>
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


