<div class="p-5 md:p-10 bg-gray-100 rounded-md">
    <h1 class="font-bangla font-bold mb-10 text-3xl text-center text-sky-900">মোট শিক্ষক  ও  শিক্ষিকা তালিকা</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
        @foreach($teachers as $teacher)
            <div class="bg-white shadow-xl rounded-lg pt-10">
                <div class="flex justify-center">
                    <img class="block w-2/3 aspect-square object-cover border rounded-full mx-auto" src="{{ $teacher->profileUrl() }}" alt="{{ $teacher->name_en }}">
                </div>
                <div class="p-2">
                    <h3 class="text-center text-xl text-gray-900 font-medium leading-8">{{ $teacher->name_en }}</h3>
                    <div class="text-center text-gray-400 text-xs font-semibold">
                        <p>{{ $teacher->designation }}</p>
                    </div>
                    <div class="text-center my-3">
                        <a href="{{ route('employee-details', ['id' => $teacher->id]) }}" class="text-md font-bold text-indigo-500 italic hover:underline hover:text-indigo-600 font-medium" href="#">Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-10">
        {{ $teachers->links() }}
    </div>
</div>
