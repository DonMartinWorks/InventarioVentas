@props(['item', 'isSubItem' => false])

@php
    $isActive = $item['active'] ?? false;
    $hasSubmenu = isset($item['submenu']);
    $classes = 'flex items-center w-full p-2 transition-all rounded-lg group';

    $activeStyles = 'border-2 border-yellow-500 bg-white border-dashed text-yellow-500';
    $inactiveStyles = 'text-gray-900 hover:bg-yellow-500 hover:text-white';

    $iconContainerActiveClasses = 'bg-yellow-500 p-2 rounded-md';
    $iconActiveClasses = 'text-white';

    $iconContainerInactiveClasses = '';
    $iconInactiveClasses = 'text-gray-600';
@endphp

@isset($item['header'])
    {{-- Header --}}
    <div class="px-3.5 py-2.5 text-xs font-semibold flex text-gray-600 uppercase">
        <span class="justify-start">
            <i class="fa-solid fa-caret-right text-base text-yellow-500 mr-2 justify-center items-center"></i>
            <span class="justify-end underline underline-offset-2">
                {{ $item['header'] }}
            </span>
        </span>
    </div>
@else
    {{-- Main Link Container --}}
    <div @if ($hasSubmenu) x-data="{ open: {{ $isActive ? 'true' : 'false' }} }" @endif>
        @php
            $linkActiveClasses = '';
            if ($isActive) {
                $linkActiveClasses = $activeStyles;
            } elseif (!$hasSubmenu) {
                $linkActiveClasses = $inactiveStyles;
            }
        @endphp

        {{-- Link or Button --}}
        @if ($hasSubmenu)
            <button x-on:click="open = !open" class="{{ $classes }} {{ $linkActiveClasses }}">
                <span
                    class="inline-flex w-6 h-6 justify-center items-center {{ $isActive ? $iconContainerActiveClasses : $iconContainerInactiveClasses }}">
                    <i class="{{ $isActive ? $iconActiveClasses : $iconInactiveClasses }} {{ $item['icon'] }}"></i>
                </span>
                <span
                    class="ms-3 text-left flex-1 {{ $isActive ? 'text-yellow-500' : 'text-gray-600' }}">{{ $item['name'] }}</span>
                <i class="fa-solid fa-angle-down transform transition-transform duration-300"
                    :class="{ 'rotate-180': open }"></i>
            </button>
        @else
            <a href="{{ $item['route'] }}" class="{{ $classes }} {{ $linkActiveClasses }}">
                <span
                    class="inline-flex w-6 h-6 justify-center items-center {{ $isActive ? $iconContainerActiveClasses : $iconContainerInactiveClasses }}">
                    <i class="{{ $isActive ? $iconActiveClasses : $iconInactiveClasses }} {{ $item['icon'] }}"></i>
                </span>
                <span class="ms-3 {{ $isActive ? 'text-yellow-500' : 'text-gray-600' }}">{{ $item['name'] }}</span>
            </a>
        @endif

        {{-- Submenu --}}
        @if ($hasSubmenu)
            <ul x-show="open" x-transition:enter="transition-all ease-in-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                x-transition:leave="transition-all ease-in-out duration-300"
                x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
                class="space-y-1 overflow-hidden {{ $isSubItem ? 'pl-6' : 'pl-6' }}">
                @foreach ($item['submenu'] as $subItem)
                    <li class="px-2 py-0.5">
                        <x-sidebar.sidebar-links :item="$subItem" isSubItem />
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endisset
