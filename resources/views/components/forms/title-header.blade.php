@props(['createRoute', 'modelName', 'allModels'])

<div class="p-4 border bg-neutral-100 border-gray-300 rounded-lg">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl uppercase font-extrabold underline underline-offset-4 text-stone-800 line-clamp-1">
            {{ __('All :name', ['name' => __($allModels)]) }}
        </h2>

        <a href="{{ route($createRoute) }}" title="{{ __('Create :name', ['name' => __($modelName)]) }}"
            class="bg-green-500 hover:bg-green-400 text-white hover:text-gray-600 font-bold py-2 px-4 rounded-md transition-colors border">
            <i class="fa-solid fa-folder-plus mr-2"></i>{{ __('Create :name', ['name' => __($modelName)]) }}
        </a>
    </div>
</div>
