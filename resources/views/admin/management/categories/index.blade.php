<x-admin-layout title="{{ __('All :name', ['name' => __('Categories')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Categories
    [
        'name' => __('Categories'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.categories.create" modelName="Categories" />
    </x-slot>

    <section>
        @livewire('admin.datatables.category-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
