@php
    $links = [
        [
            'header' => __('Main Content'),
        ],

        [
            'name' => __('Dashboard'),
            'icon' => 'fa-solid fa-grip',
            'route' => route('admin.home'),
            'active' => request()->routeIs('admin.home'),
        ],

        [
            'name' => __('Warehouse'),
            'icon' => 'fa-solid fa-warehouse',
            'active' => request()->routeIs(['admin.warehouses.*', 'admin.categories.*', 'admin.products.*']),
            'submenu' => [
                [
                    'name' => __('Warehouses'),
                    'icon' => 'fa-solid fa-warehouse',
                    'route' => route('admin.warehouses.index'),
                    'active' => request()->routeIs('admin.warehouses.*'),
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
            ],
        ],

        [
            'name' => __('Purchases'),
            'icon' => 'fa-solid fa-cart-shopping',
            'active' => request()->routeIs(['admin.suppliers.*']),
            'submenu' => [
                [
                    'name' => __('Suppliers'),
                    'icon' => 'fa-solid fa-truck',
                    'route' => route('admin.suppliers.index'),
                    'active' => request()->routeIs('admin.suppliers.*'),
                ],

                [
                    'name' => __('Purchase Orders'),
                    'route' => '',
                    'active' => false,
                ],

                [
                    'name' => __('Purchases'),
                    'route' => '',
                    'active' => false,
                ],
            ],
        ],

        [
            'name' => __('Sales'),
            'icon' => 'fa-solid fa-cash-register',
            'active' => request()->routeIs('admin.customers.*'),
            'submenu' => [
                [
                    'name' => __('Customers'),
                    'icon' => 'fa-solid fa-clipboard-user',
                    'route' => route('admin.customers.index'),
                    'active' => request()->routeIs('admin.customers.*'),
                ],

                [
                    'name' => __('Quotes'),
                    'route' => '',
                    'active' => false,
                ],

                [
                    'name' => __('Sales'),
                    'route' => '',
                    'active' => false,
                ],
            ],
        ],

        [
            'name' => __('Movements'),
            'icon' => 'fa-solid fa-arrows-rotate',
            'active' => false,
            'submenu' => [
                [
                    'name' => __('Inputs and Outputs'),
                    'route' => '',
                    'active' => false,
                ],

                [
                    'name' => __('Transfers'),
                    'route' => '',
                    'active' => false,
                ],
            ],
        ],

        [
            'name' => __('Reports'),
            'icon' => 'fa-solid fa-chart-line',
            'route' => '',
            'active' => false,
        ],

        [
            'header' => __('Configurations'),
        ],

        [
            'name' => __('Users'),
            'icon' => 'fa-solid fa-users',
            'route' => '',
            'active' => false,
        ],

        [
            'name' => __('Roles'),
            'icon' => 'fa-solid fa-shield-halved',
            'route' => '',
            'active' => false,
        ],

        [
            'name' => __('Permissions'),
            'icon' => 'fa-solid fa-lock',
            'route' => '',
            'active' => false,
        ],

        [
            'name' => __('Configurations'),
            'icon' => 'fa-solid fa-gears',
            'route' => '',
            'active' => false,
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-neutral-50 border-r border-gray-300 sm:translate-x-0"
    :class="{
        'transform-none': open,
        '-translate-x-full': !open
    }" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <div class="mt-5">
            <ul class="space-y-2 font-medium">
                @foreach ($links as $item)
                    <x-sidebar.sidebar-links :item="$item" />
                @endforeach
            </ul>
        </div>
    </div>
</aside>
