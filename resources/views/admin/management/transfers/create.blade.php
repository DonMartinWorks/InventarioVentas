<x-admin-layout title="{{ __('Create :name', ['name' => __('Inputs and Outputs')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    [
        'name' => __('Inputs and Outputs'),
        'url' => route('admin.movements.index'),
    ],

    [
        'name' => __('Create :name', ['name' => __('Movement')]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ __('Create :name', ['name' => __('Movement')]) }}</h2>
    </x-wire-card>

    <div class="mt-4">
        @livewire('admin.movement.movement-create')
    </div>
</x-admin-layout>
