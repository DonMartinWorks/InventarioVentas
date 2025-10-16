<x-admin-layout title="{{ __('Create :name', ['name' => __('Quote')]) }}" :breadcrumb="[
    // Route Dashboard
    [
        'name' => __('Dashboard'),
        'url' => route('admin.home'),
    ],

    [
        'name' => __('Quotes'),
        'url' => route('admin.quotes.index'),
    ],

    [
        'name' => __('Create :name', ['name' => __('Quote')]),
    ],
]">
    <x-wire-card>
        <h2 class="text-2xl/7 font-bold text-gray-700 sm:truncate sm:text-3xl sm:tracking-tight">
            {{ __('Create :name', ['name' => __('Quote')]) }}</h2>
    </x-wire-card>

    <div class="mt-4">
        @livewire('admin.quote.quote-create')
    </div>
</x-admin-layout>
