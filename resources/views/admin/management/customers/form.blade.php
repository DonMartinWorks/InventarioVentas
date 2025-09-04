<div class="space-y-4 mb-8">
    <x-wire-input label="{{ __('Name') }}" name="name"
        placeholder="{{ __('Please insert this information: :name', ['name' => __('Name')]) }}"
        value="{{ old('name', @$customer->name) }}" required />
</div>
