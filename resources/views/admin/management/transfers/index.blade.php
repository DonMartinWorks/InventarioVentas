<x-admin-layout title="{{ __('All :name', ['name' => __('Transfers')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Transfers
    [
        'name' => __('Transfers'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.transfers.create" modelName="Transfer" />
    </x-slot>

    <section>
        @livewire('admin.datatables.movement-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
