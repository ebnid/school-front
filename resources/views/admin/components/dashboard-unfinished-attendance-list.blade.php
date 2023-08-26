<div class="bg-white p-5 rounded-md">
    <h1 class="text-xl font-bold mb-4 text-gray-600">Unfinished Attendance List</h1>
    @if(count($attendances) > 0)
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances ?? [] as $attendance)
                <tr class="whitespace-nowrap group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $attendance->created_at->format('d M Y h:i A') }}
                    </th>
                    <td class="px-6 py-4">
                        @if($attendance->in_at)
                            {{ $attendance->in_at->format('h:i A') }}
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $attendances->links() }}
    </div>
    @else 
        <span class="text-xs text-center block">No unfinished attendace yet !</span>
    @endif
</div>