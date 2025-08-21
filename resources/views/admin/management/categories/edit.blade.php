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
    cate
</x-admin-layout>
