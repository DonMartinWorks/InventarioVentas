<x-admin-layout title="{{ __('All :name', ['name' => __('Products')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Products
    [
        'name' => __('Products'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.products.create" modelName="Products" />
    </x-slot>

    <section class="mt-8">
        @livewire('admin.datatables.category-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
