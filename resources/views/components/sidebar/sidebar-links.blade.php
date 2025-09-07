@props(['item', 'isSubItem' => false])

@php
    $isActive = $item['active'] ?? false;
    $hasSubmenu = isset($item['submenu']);

    $baseClasses = 'bg-white flex items-center w-full py-2 px-3 transition-all rounded-md group border';

    $activeStyles = 'bg-yellow-50 text-yellow-600 font-semibold border-yellow-300';
    $inactiveStyles = 'text-gray-600 border-gray-200';

    $iconContainerActiveClasses = 'bg-yellow-500 rounded-full w-7 h-7 flex justify-center items-center';
    $iconActiveClasses = 'text-white';
    $iconContainerInactiveClasses = 'bg-transparent';
    $iconInactiveClasses = 'text-gray-500';

    $hoverStyles = 'hover:bg-yellow-50 hover:text-yellow-600 hover:font-semibold hover:border-yellow-300';
    $hoverIconContainerStyles = 'group-hover:bg-yellow-500 rounded-full w-7 h-7 flex justify-center items-center';
    $hoverIconStyles = 'group-hover:text-white';

    $withoutIcon = 'fa-solid fa-minus';
@endphp

@isset($item['header'])
    {{-- Header with subtle separator --}}
    <div class="px-2 py-3 text-xs text-center font-semibold text-gray-500 uppercase underline underline-offset-4">
        {{ $item['header'] }}
    </div>
@else
    {{-- Main Link Container --}}
    <div @if ($hasSubmenu) x-data="{ open: {{ $isActive ? 'true' : 'false' }} }" @endif>
        @php
            $linkActiveClasses = $isActive ? $activeStyles : $inactiveStyles;
        @endphp

        {{-- Link or Button --}}
        @if ($hasSubmenu)
            <button x-on:click="open = !open" class="{{ $baseClasses }} {{ $linkActiveClasses }} {{ $hoverStyles }}">
                <span
                    class="inline-flex w-5 h-5 justify-center items-center {{ $isActive ? $iconContainerActiveClasses : $iconContainerInactiveClasses }} {{ $hoverIconContainerStyles }}">
                    <i
                        class="w-4 h-4 {{ $isActive ? $iconActiveClasses : $iconInactiveClasses }} {{ $hoverIconStyles }} {{ $item['icon'] ?? $withoutIcon }}"></i>
                </span>

                <span
                    class="ms-3 flex-1 text-left {{ $isActive ? 'text-yellow-600' : 'text-gray-700' }} group-hover:text-yellow-600">{{ $item['name'] }}</span>

                <i class="fa-solid fa-angle-down transform transition-transform duration-300 {{ $isActive ? 'text-yellow-600' : 'text-gray-400' }} group-hover:text-yellow-600"
                    :class="{ 'rotate-180': open }"></i>
            </button>
        @else
            <a href="{{ $item['route'] }}" class="{{ $baseClasses }} {{ $linkActiveClasses }} {{ $hoverStyles }}">
                <span
                    class="inline-flex w-5 h-5 justify-center items-center {{ $isActive ? $iconContainerActiveClasses : $iconContainerInactiveClasses }} {{ $hoverIconContainerStyles }}">
                    <i
                        class="w-4 h-4 {{ $isActive ? $iconActiveClasses : $iconInactiveClasses }} {{ $hoverIconStyles }} {{ $item['icon'] ?? $withoutIcon }}"></i>
                </span>

                <span
                    class="ms-3 {{ $isActive ? 'text-yellow-600' : 'text-gray-700' }} group-hover:text-yellow-600">{{ $item['name'] }}</span>
            </a>
        @endif

        {{-- Submenu --}}
        @if ($hasSubmenu)
            <ul x-show="open" x-transition:enter="transition-all ease-in-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                x-transition:leave="transition-all ease-in-out duration-300"
                x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0"
                class="space-y-2 overflow-hidden border-l border-stone-300 ml-3 pl-3 py-2 my-2">
                @foreach ($item['submenu'] as $subItem)
                    <li>
                        <x-sidebar.sidebar-links :item="$subItem" isSubItem />
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endisset
