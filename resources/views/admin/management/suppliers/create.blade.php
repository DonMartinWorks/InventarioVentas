<x-admin-layout title="{{ __('Create :name', ['name' => __('Supplier')]) }}" :breadcrumb="[
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
        'name' => __('Create :name', ['name' => __('Supplier')]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight md:mb-8 mb-3">
            {{ __('Create :name', ['name' => __('Supplier')]) }}</h2>

        <x-forms.form-structure :route="route('admin.suppliers.store')">
            @include('admin.management.suppliers.form')

            <section class="flex justify-end">
                <x-wire-button type="submit" light gray label="{{ __('Save') }}" right-icon="check" flat
                    interaction:solid="positive" />
            </section>
        </x-forms.form-structure>
    </x-wire-card>
</x-admin-layout>
