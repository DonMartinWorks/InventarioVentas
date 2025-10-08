<x-admin-layout title="{{ __('Create :name', ['name' => __('Purchases')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    [
        'name' => __('Purchases'),
        'url' => route('admin.purchases.index'),
    ],

    [
        'name' => __('Create :name', ['name' => __('Purchases')]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ __('Create :name', ['name' => __('Purchases')]) }}</h2>
    </x-wire-card>

    <div class="mt-4">
        @livewire('admin.purchase.purchase-create')
    </div>
</x-admin-layout>
