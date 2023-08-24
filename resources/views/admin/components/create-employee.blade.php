<div class="bg-white p-7 max-w-2xl">

    <!-- Validation errors -->
    <x-errors />

    <!-- Form -->
    <form wire:submit.prevent="createEmployeeHandeler" class="space-y-5">

   
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input wire:model.debounce="name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>


       
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input wire:model.debounce="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
  

   
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
            <input wire:model.debounce="phone" type="number" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
    


        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <textarea wire:model.debounce="address" id="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address"></textarea>
        </div>


   
        <div>
            <label for="basic_salary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Basic Salary</label>
            <input wire:model.debounce="basic_salary" type="number" id="basic_salary" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
      

        
        <div>
            <label for="orgs" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Organization</label>
            <select wire:model.debounce="organization_id" id="orgs" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Choose a organization</option>
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}">{{ $organization->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="designation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Designation</label>
            <select wire:model.debounce="designation_id" id="designation" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Choose a designation</option>
                @foreach($designations as $designation)
                    <option value="{{ $designation->id }}">{{ $designation->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="shift" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift</label>
            <select wire:model.debounce="shift_id" id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Choose a shift</option>
                @foreach($shifts as $shift)
                    <option value="{{ $shift->id }}">{{ $shift->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
            <fieldset class="flex flex-wrap gap-3">
                <legend class="sr-only">Role</legend>

                <div>
                    <input
                    wire:model.debounce="role"
                    type="radio"
                    name="role"
                    value="root"
                    class="peer hidden"
                    id="root"
                    />

                    <label
                    for="root"
                    class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 bg-white px-3 py-2 text-gray-900 hover:border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white"
                    >
                    <p class="text-sm font-medium">Root</p>
                    </label>
                </div>

                <div>
                    <input
                    wire:model.debounce="role"
                    type="radio"
                    name="role"
                    value="admin"
                    id="admin"
                    class="peer hidden"
                    />

                    <label
                    for="admin"
                    class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 bg-white px-3 py-2 text-gray-900 hover:border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white"
                    >
                    <p class="text-sm font-medium">Admin</p>
                    </label>
                </div>

                <div>
                    <input
                    wire:model.debounce="role"
                    type="radio"
                    name="role"
                    value="employee"
                    id="employee"
                    class="peer hidden"
                    />

                    <label
                    for="employee"
                    class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 bg-white px-3 py-2 text-gray-900 hover:border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white"
                    >
                    <p class="text-sm font-medium">Employee</p>
                    </label>
                </div>
            </fieldset>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Account Status</label>
            <fieldset class="flex flex-wrap gap-3">
                <legend class="sr-only">Role</legend>

                <div>
                    <input
                    wire:model.debounce="status"
                    type="radio"
                    name="status"
                    value="running"
                    class="peer hidden"
                    id="running"
                    />

                    <label
                    for="running"
                    class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 bg-white px-3 py-2 text-gray-900 hover:border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white"
                    >
                    <p class="text-sm font-medium">Running</p>
                    </label>
                </div>

                <div>
                    <input
                    wire:model.debounce="status"
                    type="radio"
                    name="status"
                    value="go-out"
                    id="go-out"
                    class="peer hidden"
                    />

                    <label
                    for="go-out"
                    class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 bg-white px-3 py-2 text-gray-900 hover:border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-checked:text-white"
                    >
                    <p class="text-sm font-medium">Go Out</p>
                    </label>
                </div>

            </fieldset>
        </div>

        <div class="flex gap-5">
            <div class="flex-1">
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input wire:model.debounce="password" type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                </div>
            </div>
            <div class="flex-1">
                <div>
                    <label for="confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm</label>
                    <input wire:model.debounce="confirm" type="text" id="confirm" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                </div>
            </div>
        </div>

        <x-button  type="submit" >Add</x-button>

    </form>

</div>