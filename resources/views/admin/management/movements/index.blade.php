<x-admin-layout title="{{ __('All :name', ['name' => __('Inputs and Outputs')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Movements
    [
        'name' => __('Inputs and Outputs'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.movements.create" modelName="Inputs/Output" allModels="Inputs and Outputs" />
    </x-slot>

    <section>
        @livewire('admin.datatables.movement-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
