<x-admin-layout title="{{ __('All :name', ['name' => __('Suppliers')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Suppliers
    [
        'name' => __('Suppliers'),
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
        <x-forms.title-header createRoute="admin.suppliers.create" modelName="Suppliers" />
    </x-slot>

    <section class="mt-8">
        @livewire('admin.datatables.supplier-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
