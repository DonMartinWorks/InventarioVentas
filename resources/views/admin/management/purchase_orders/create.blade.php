<x-admin-layout title="{{ __('Create :name', ['name' => __('Purchase Order')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    [
        'name' => __('Purchase Orders'),
        'url' => route('admin.purchase-orders.index'),
    ],

    [
        'name' => __('Create :name', ['name' => __('Purchase Order')]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ __('Create :name', ['name' => __('Purchase Order')]) }}</h2>
    </x-wire-card>

    <div class="mt-4">
        @livewire('admin.purchase-order.purchase-order-create')
    </div>
</x-admin-layout>
