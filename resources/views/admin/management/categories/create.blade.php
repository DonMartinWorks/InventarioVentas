<x-admin-layout title="{{ __('Create :name', ['name' => __('Category')]) }}" :breadcrumb="[
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
        'name' => __('Create :name', ['name' => __('Category')]),
    ],
]">
    cate
</x-admin-layout>
