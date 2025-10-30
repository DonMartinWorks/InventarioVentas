<x-admin-layout title="{{ __('All :name', ['name' => __('Purchases')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Purchases
    [
        'name' => __('Purchases'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.purchases.create" modelName="Purchase" allModels="Purchases" />
    </x-slot>

    <section>
        @livewire('admin.datatables.purchase-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
