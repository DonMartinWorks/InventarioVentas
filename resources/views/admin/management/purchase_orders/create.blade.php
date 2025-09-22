<x-admin-layout title="{{ __('Create :name', ['name' => __('Purchase Order')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    [
        'name' => __('Purchase Orders'),
        'url' => route('admin.purchase-orders.index')
    ],

    [
        'name' => __('Create :name', ['name' => __('Purchase Order')]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight md:mb-8 mb-3">
            {{ __('Create :name', ['name' => __('Purchase Order')]) }}</h2>

            <!-- TODO: form -->
    </x-wire-card>
</x-admin-layout>
