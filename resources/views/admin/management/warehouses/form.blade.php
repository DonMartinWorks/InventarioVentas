<div class="space-y-4 mb-8">
    <x-wire-input label="{{ __('Name') }}" name="name"
        placeholder="{{ __('Please insert this information: :name', ['name' => __('Name')]) }}"
        value="{{ old('name', @$category->name) }}" required />

    {{-- <x-wire-textarea label="{{ __('Description') }}" name="description"
        placeholder="{{ __('Please insert this information: :name', ['name' => __('Description')]) }}">{{ old('description', @$category->description) }}</x-wire-textarea> --}}
</div>
