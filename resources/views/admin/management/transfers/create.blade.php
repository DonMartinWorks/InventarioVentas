<x-admin-layout title="{{ __('Create :name', ['name' => __('Transfers')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    [
        'name' => __('Transfers'),
        'url' => route('admin.transfers.index'),
    ],

    [
        'name' => __('Create :name', ['name' => __('Transfer')]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ __('Create :name', ['name' => __('Transfer')]) }}</h2>
    </x-wire-card>

    <div class="mt-4">
        @livewire('admin.transfer.transfer-create')
    </div>
</x-admin-layout>
