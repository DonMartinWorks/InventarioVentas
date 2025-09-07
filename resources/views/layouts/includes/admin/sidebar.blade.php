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

        [
            'name' => __('Customers'),
            'icon' => 'fa-solid fa-clipboard-user',
            'route' => route('admin.customers.index'),
            'active' => request()->routeIs('admin.customers.*'),
        ],

        // Header 1
        [
            'header' => __('Manage page'),
        ],

        // Users
        [
            'name' => __('Users'),
            'icon' => 'fa-solid fa-users',
            'route' => '',
            'active' => false,
        ],

        // Image
        [
            'name' => __('Image'),
            'icon' => 'fa-solid fa-image',
            'route' => '',
            'active' => false,
        ],

        [
            'name' => __('Test'),
            'icon' => 'fa-solid fa-building',
            'active' => false,
            'submenu' => [
                [
                    'name' => __('Test 1'),
                    'icon' => 'fa-solid fa-circle-info',
                    'route' => '',
                    'active' => false,
                ],
                [
                    'name' => __('Test 2'),
                    'icon' => 'fa-solid fa-address-card',
                    'route' => '',
                    'active' => false,
                ],
                [
                    'name' => __('Test 3'),
                    'icon' => 'fa-solid fa-id-card',
                    'route' => '',
                    'active' => false,
                ],
            ],
        ],

        // Test (Submenu)
        [
            'name' => __('Test 2'),
            'icon' => 'fa-solid fa-glasses',
            'active' => true,
            'submenu' => [
                [
                    'name' => __('Information'),
                    'icon' => 'fa-solid fa-circle-info',
                    'route' => '',
                    'active' => false,
                ],
                [
                    'name' => __('About Us'),
                    'icon' => 'fa-solid fa-address-card',
                    'route' => '',
                    'active' => true,
                ],
            ],
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-slate-50 border-r border-gray-200 sm:translate-x-0"
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
