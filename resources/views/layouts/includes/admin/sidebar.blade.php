@php
    $links = [
        // Dashboard
        [
            'name' => __('Dashboard'),
            'icon' => 'fa-solid fa-grip',
            'route' => route('admin.home'),
            'active' => request()->routeIs('admin.home'),
        ],

        [
            'name' => __('Categories'),
            'icon' => 'fa-solid fa-tag',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
        ],

        [
            'name' => __('Products'),
            'icon' => 'fa-solid fa-box-archive',
            'route' => route('admin.products.index'),
            'active' => request()->routeIs('admin.products.*'),
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-50 border-r border-gray-200 sm:translate-x-0"
    :class="{
        'transform-none': open,
        '-translate-x-full': !open
    }" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $item)
                <x-sidebar.sidebar-links :item="$item" />
            @endforeach
        </ul>
    </div>
</aside>
