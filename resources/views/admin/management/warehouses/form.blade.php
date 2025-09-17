<div class="space-y-4 mb-8">
    <div class="grid md:grid-cols-5 grid-cols-1 gap-6">
        <div class="col-span-1 md:col-span-2">
            <x-wire-input label="{{ __('Name') }}" name="name"
                placeholder="{{ __('Please insert this information: :name', ['name' => __('Name')]) }}"
                value="{{ old('name', @$warehouse->name) }}" required />
        </div>

        <div class="col-span-1 md:col-span-3">
            <x-wire-input label="{{ __('Location') }}" name="location"
                placeholder="{{ __('Please insert this information: :name', ['name' => __('Location')]) }}"
                value="{{ old('location', @$warehouse->location) }}" />
        </div>
    </div>
</div>
