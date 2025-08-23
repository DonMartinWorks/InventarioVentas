<x-admin-layout title="{{ __('Dashboard') }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    // Route Admin
    [
        'name' => __('Dashboard'),
    ],
]"><i
        class="fa-solid fa-face-smile mr-2"></i>{{ __('Dashboard') }}
</x-admin-layout>
