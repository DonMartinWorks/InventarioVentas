@props(['model', 'editRoute', 'destroyRoute', 'titleName'])

<div class="flex items-center space-x-2">
    <!-- Edit Button -->
    <x-wire-button outline warning title="{{ __('Edit :name', ['name' => $titleName]) }}" href="{{ $editRoute }}">
        <x-wire-icon name="pencil" class="w-4 h-4" outline />
    </x-wire-button>

    <!-- Delete Button -->
    <form action="{{ $destroyRoute }}" method="POST">
        @csrf
        @method('DELETE')
        <x-wire-button outline negative title="{{ __('Destroy :name', ['name' => $titleName]) }}" type="submit">
            <x-wire-icon name="trash" class="w-4 h-4" outline />
        </x-wire-button>
    </form>
    {{-- <form action="{{ $destroyRoute }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button outline negative title="{{ __('Destroy :name', ['name' => $titleName]) }}" type="submit">
            <x-wire-icon name="trash" class="w-4 h-4" outline />
        </x-wire-button>
    </form> --}}
</div>
