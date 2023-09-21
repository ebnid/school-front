
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


    $target_month = request()->month;
    $target_year = request()->year;


    $teaders_list = \App\Models\Attendance::select('name')->groupBy('name')->get();

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
        </style>
    </head>
<body>
    <main class="mx-auto">

        <table>
            <thead>
                <th>#</th>
                <th>Teacher Name</th>
                @foreach(getDaysOfMonth($target_year, $target_month) as $date)
                    <th>{{ $date }}</th>
                @endforeach
            </thead>
            <tbody>
                @foreach($teaders_list as $_teacher)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td class="whitespace-nowrap">{{ $_teacher->name }}</td>
                        @foreach(getDaysOfMonth($target_year, $target_month) as $date)

                            @php 
                                 // $attendance = \App\Models\Attendance::whereYear('date', getYear($date))->whereMonth('date', getMonth($date))->whereDay('date', getDay($date))->where('name', $_teacher->name)->first();
                                $attendance = \App\Models\Attendance::whereDate('date', $date)->where('name', $_teacher->name)->first();
                            @endphp

                            <td class="whitespace-nowrap">
                                @if($attendance)
                                    <span class="block">Date - @if($attendance->date) {{ $attendance->date->format('d-m-y') }} @endif</span>
                                    <span class="block">In - @if($attendance->clock_in) {{ $attendance->clock_in->format('h:i A') }} @endif</span>
                                    <span class="block">Out -  @if($attendance->clock_out) {{ $attendance->clock_out->format('h:i A') }} @endif</span>
                                    <span class="block">Late -  </span>
                                    <span class="block">Work -  </span>
                                @else 
                                    'Absent'
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>

        </table>
    </mian>
</body>
</html>


