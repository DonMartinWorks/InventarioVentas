<x-admin-layout title="{{ __('All :name', ['name' => __('Sales')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Sales
    [
        'name' => __('Sales'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.sales.create" modelName="Sale" allModels="Sales" />
    </x-slot>

    <section>
        @livewire('admin.datatables.sale-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
