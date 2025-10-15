<x-admin-layout title="{{ __('All :name', ['name' => __('Quotes')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Quotes
    [
        'name' => __('Quotes'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.quotes.create" modelName="Quotes" />
    </x-slot>

    <section>
        @livewire('admin.datatables.purchase-order-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
