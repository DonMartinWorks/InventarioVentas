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
    @push('css')
        <style>
            table th span,
            table td {
                font-size: 0.80rem !important;
            }

            /*
            .product-image {
                width: 5rem !important;
                height: 3rem !important;
                object-fit: cover !important;
                object-position: center !important;
            }
            */
        </style>
    @endpush

    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.products.create" modelName="Products" />
    </x-slot>

    <section class="mt-8">
        @livewire('admin.datatables.product-datatable')
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
