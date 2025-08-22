@props(['createRoute', 'modelName'])

<div class="p-4 border bg-gray-50 rounded-lg">
    <div class="flex items-center justify-between mx-2">
        <h2 class="text-2xl uppercase font-extrabold underline underline-offset-4 text-stone-800">
            {{ __('All :name', ['name' => __($modelName)]) }}
        </h2>

        <a href="{{ route($createRoute) }}"
            class="bg-green-500 text-white font-bold py-2 px-4 rounded-md border shadow-md">
            <i class="fa-solid fa-folder-plus mr-2"></i>{{ __('Create :name', ['name' => __($modelName)]) }}
        </a>
    </div>
</div>
