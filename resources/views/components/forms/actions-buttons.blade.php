@props(['model', 'editRoute', 'destroyRoute', 'titleName'])

<div class="flex items-center space-x-2">
    <!-- Edit Button -->
    <x-wire-button lg warning title="{{ __('Edit :name', ['name' => $titleName]) }}" href="{{ $editRoute }}">
        <x-wire-icon name="pencil" class="w-4 h-4" lg />
    </x-wire-button>

    <!-- Delete Button -->
    <form action="{{ $destroyRoute }}" method="POST" class="delete-resource-form">
        @csrf
        @method('DELETE')
        <x-wire-button lg negative title="{{ __('Destroy :name', ['name' => $titleName]) }}" type="submit">
            <x-wire-icon name="trash" class="w-4 h-4" lg />
        </x-wire-button>
    </form>
</div>
