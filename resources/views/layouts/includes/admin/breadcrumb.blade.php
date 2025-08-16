@if (count($breadcrumb) > 0)
    <div class="md:flex md:space-x-4 mb-4">
        <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 mb-4 md:mb-0 md:flex-grow-0 md:w-8/12"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                @foreach ($breadcrumb as $item)
                    @if ($loop->first)
                        {{-- First item (Home) --}}
                        <li class="inline-flex items-center">
                            <div class="flex items-center">
                                {{-- Home icon --}}
                                <svg class="w-3 h-3 me-2.5 text-sky-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                {{-- Home link or span based on URL existence --}}
                                @isset($item['url'])
                                    <a href="{{ $item['url'] }}"
                                        class="text-sm font-medium text-gray-500 hover:text-yellow-500">{{ $item['name'] }}</a>
                                @else
                                    <span
                                        class="text-sm font-semibold text-gray-500 cursor-default hover:underline hover:underline-offset-4">{{ $item['name'] }}</span>
                                @endisset
                            </div>
                        </li>
                    @else
                        {{-- All other items --}}
                        <li>
                            <div class="flex items-center">
                                {{-- Arrow icon for all but the first item --}}
                                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                {{-- Link or span based on URL existence --}}
                                @isset($item['url'])
                                    <a href="{{ $item['url'] }}"
                                        class="ms-1 text-sm font-medium text-gray-500 hover:text-yellow-500 md:ms-2">{{ $item['name'] }}</a>
                                @else
                                    <span
                                        class="ms-1 text-sm font-semibold text-yellow-500 cursor-default md:ms-2 underline underline-offset-4">{{ $item['name'] }}</span>
                                @endisset
                            </div>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>

        @if (count($breadcrumb) > 1)
            <div
                class="w-full md:w-4/12 flex items-center justify-center p-2 border border-gray-200 rounded-lg bg-gray-50">
                <h6 class="text-lg font-extrabold leading-none tracking-tight text-gray-600 md:text-xl">
                    <i class="fa-solid fa-location-dot text-sky-500"></i>&#160;&#160;{{ end($breadcrumb)['name'] }}
                </h6>
            </div>
        @endif
    </div>
@endif
