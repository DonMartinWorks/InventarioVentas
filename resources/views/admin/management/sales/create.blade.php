<x-admin-layout title="{{ __('Create :name', ['name' => __('Sale')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    [
        'name' => __('Sales'),
        'url' => route('admin.sales.index'),
    ],

    [
        'name' => __('Create :name', ['name' => __('Sale')]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ __('Create :name', ['name' => __('Sale')]) }}</h2>
    </x-wire-card>

    <div class="mt-4">
        @livewire('admin.sale.sale-create')
    </div>
</x-admin-layout>
