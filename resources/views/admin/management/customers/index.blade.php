<x-admin-layout title="{{ __('All :name', ['name' => __('Customers')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Customers
    [
        'name' => __('Customers'),
    ],
]">
    @push('css')
        <style>
            table th span,
            table td {
                font-size: 0.80rem !important;
            }
        </style>
    @endpush

    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.customers.create" modelName="Customers" />
    </x-slot>

    <section>
        @livewire('admin.datatables.customer-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
