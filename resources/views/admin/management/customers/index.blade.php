<x-admin-layout title="{{ __('All :name', ['name' => __('Customers')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Customers
    [
        'name' => __('Customers'),
    ],
]">
    <x-slot name="actions">
        <x-forms.title-header createRoute="admin.customers.create" modelName="Customers" />
    </x-slot>

    <section class="mt-8">
        {{--  --}}
    </section>

    @push('js')
        <x-plugins.scripts.sweet-alert-confirm />
    @endpush
</x-admin-layout>
