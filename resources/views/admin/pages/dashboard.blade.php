<x-master-layout title="Dashboard">

    <livewire:dashboard-stats />

    <div class="mt-5">
        <livewire:create-overtime />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">

        <div>
            <livewire:notice-board />
        </div>

        <div>
            <livewire:task-board />
        </div>

        <div>
            <livewire:dashboard-overtime-list />
        </div>

        <div>
            <livewire:dashboard-unfinished-attendance-list />
        </div>
    </div>
    
</x-master-layout>

