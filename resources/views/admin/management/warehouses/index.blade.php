<x-admin-layout title="{{ __('All :name', ['name' => __('Warehouses')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Warehouses
    [
        'name' => __('Warehouses'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.warehouses.create" modelName="Warehouse" allModels="Warehouses" />
    </x-slot>

    <section>
        @livewire('admin.datatables.warehouse-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
