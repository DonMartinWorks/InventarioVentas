<x-admin-layout title="{{ __('Edit :name', ['name' => __('Category') . ': ' . $category->name]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Categories
    [
        'name' => __('Categories'),
        'url' => route('admin.categories.index'),
    ],

    [
        'name' => __('Edit :name', ['name' => __('Category') . ': ' . $category->name]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight md:mb-8 mb-3">
            {{ __('Edit :name', ['name' => __('Category')]) }}</h2>

        <x-forms.form-structure :route="route('admin.categories.update', $category)" formMethod="PUT">
            @include('admin.management.categories.form')

            <section class="flex justify-end">
                <x-wire-button type="submit" light gray label="{{ __('Update :name', ['name' => $category->name]) }}"
                    right-icon="check" flat interaction:solid="positive" />
            </section>
        </x-forms.form-structure>
    </x-wire-card>
</x-admin-layout>
