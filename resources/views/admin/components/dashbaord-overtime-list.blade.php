<div class="bg-white p-5 rounded-md">
    <h1 class="text-xl font-bold mb-4 text-gray-600">This month overtime list</h1>
    @if(count($overtimes) > 0)
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
                        End At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($overtimes ?? [] as $overtime)
                <tr class="whitespace-nowrap group bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $overtime->created_at->format('d M Y h:i A') }}
                    </th>
                    <td class="px-6 py-4">
                        @if($overtime->start_at)
                            {{ $overtime->start_at->format('h:i A') }}
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($overtime->end_at)
                            {{ $overtime->end_at->format('h:i A') }}
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $overtime->overtime ?? 0 }} m
                    </td>
                    <td class="px-6 py-4">
                        @if($overtime->status === 'pending')
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                        @elseif($overtime->status === 'accepted')
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Accepted</span>
                        @elseif($overtime->status === 'canceled')
                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Canceled</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $overtimes->links() }}
    </div>
    @else 
        <span class="text-xs text-center block">No overtimes yet !</span>
    @endif
</div>

