<x-admin-layout title="{{ __('Edit :name', ['name' => __('Supplier') . ': ' . $supplier->name]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Suppliers
    [
        'name' => __('Suppliers'),
        'url' => route('admin.suppliers.index'),
    ],

    [
        'name' => __('Edit :name', ['name' => __('Supplier') . ': ' . $supplier->name]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight md:mb-8 mb-3">
            {{ __('Edit :name', ['name' => __('Supplier')]) }}</h2>

        <x-forms.form-structure :route="route('admin.suppliers.update', $supplier)" formMethod="PUT">
            @include('admin.management.suppliers.form')

            <section class="flex justify-end">
                <x-wire-button type="submit" light gray label="{{ __('Update :name', ['name' => $supplier->name]) }}"
                    right-icon="check" flat interaction:solid="positive" />
            </section>
        </x-forms.form-structure>
    </x-wire-card>
</x-admin-layout>
