<x-admin-layout title="{{ __('All :name', ['name' => __('Purchase Orders')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Purchase Orders
    [
        'name' => __('Purchase Orders'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.purchase-orders.create" modelName="Purchase Orders" />
    </x-slot>

    <section>
        @livewire('admin.datatables.purchase-order-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
